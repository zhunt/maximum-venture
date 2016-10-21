<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

use Intervention\Image\ImageManagerStatic as Image;

/**
 * ImageUploads Controller
 *
 * @property \App\Model\Table\ImageUploadsTable $ImageUploads
 */
class ImageUploadsController extends AppController
{

    private $imageSizes = [
        'sm_thumb' => ['w' => 54 , 'h' => 54 ],
        'thumb_x2' => ['w' => 108 , 'h' => 108 ],
        'blog_large' => ['w' => 850, 'h' => 310 ],
        'blog_large_x2' => ['w' => 1700, 'h' => 620 ],
        'blog_thumb' => ['w' => 360, 'h' => 228 ],
        'blog_thumb_x2' => ['w' => 720, 'h' => 456 ],
        'social' => ['w' => 800, 'h' => 600 ]
    ];


    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('imageUploads', $this->paginate($this->ImageUploads));
        $this->set('_serialize', ['imageUploads']);
    }

    /**
     * View method
     *
     * @param string|null $id Image Upload id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $imageUpload = $this->ImageUploads->get($id, [
            'contain' => []
        ]);
        $this->set('imageUpload', $imageUpload);
        $this->set('_serialize', ['imageUpload']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $imageUpload = $this->ImageUploads->newEntity();
        if ($this->request->is('post')) {

            //debug($_FILES);

            $imageUpload = $this->ImageUploads->patchEntity($imageUpload, $this->request->data);

            if ( !$imageUpload->errors()) { 
                $result = $this->process_save_uploaded_files();

              // debug($imageUpload); exit;

                $imageUpload->filename = $result['filename']; 
                $imageUpload->file_meta = $result['meta'];  

                if (empty($imageUpload->name)) {
                    $imageUpload->name = $result['name'];
                }
            }
            debug($imageUpload); //exit;
            if ($this->ImageUploads->save($imageUpload)) {

               //debug($imageUpload);

        
/*
[
    'filename' => [
        'name' => 'dubuque-fest-logo.jpg',
        'type' => 'image/jpeg',
        'tmp_name' => 'C:\xampp3\tmp\php5870.tmp',
        'error' => (int) 0,
        'size' => (int) 58815
    ]
]
*/


                $this->Flash->success('The image upload has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The image upload could not be saved. Please, try again.');
            }
        }
        $this->set(compact('imageUpload'));
        $this->set('_serialize', ['imageUpload']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Image Upload id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $imageUpload = $this->ImageUploads->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $imageUpload = $this->ImageUploads->patchEntity($imageUpload, $this->request->data);
            if ($this->ImageUploads->save($imageUpload)) {
                $this->Flash->success('The image upload has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The image upload could not be saved. Please, try again.');
            }
        }
        $this->set(compact('imageUpload'));
        $this->set('_serialize', ['imageUpload']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Image Upload id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $imageUpload = $this->ImageUploads->get($id);

       // debug($imageUpload->filename);
       // debug($imageUpload->file_meta);

        $file = new File(WWW_ROOT . DS . 'img' . DS . $imageUpload->filename ); //->delete(); //->close();
        $file->delete(); $file->close();

        $data = json_decode( $imageUpload->file_meta, true ); 

        foreach ($data['sizes'] as $key => $row) {
            $file = new File(WWW_ROOT . 'img' . DS . $row['filename'] );
            $file->delete(); $file->close();
        }


       // debug( File::exists( WWW_ROOT . $imageUpload->filename) );
       // exit;
        if ($this->ImageUploads->delete($imageUpload)) {
            $this->Flash->success('The image upload has been deleted.');
        } else {
            $this->Flash->error('The image upload could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }


    /*
    * move files to correct folder, create folder if needed
    * create alt sizes
    */

    private function process_save_uploaded_files() {
        //debug($_FILES);


        $img = Image::make($_FILES['filename']['tmp_name']);

        $baseFilename = $_FILES['filename']['name'];

        $yearMonth = date('Y') . DS . date('m');
        $fullPath =  WWW_ROOT . 'img' . DS . $yearMonth;

        $dir = new Folder( $fullPath , true, 0755);


        // save the orginal
        $img->save( $fullPath . DS . $baseFilename );

        $metaFiles = [];
        foreach( $this->imageSizes as $key => $row ) {
            $img = Image::make($_FILES['filename']['tmp_name']);
            $img->fit( $row['w'], $row['h'] )->save( $fullPath . DS . $key . '-' . $baseFilename, 80 ); // default is 90 for image quality
            $metaFiles[$key] = [ 'filename' => $yearMonth . DS . $key . '-' . $baseFilename ];
        }

        //$img->fit( 200,200);

        //$img->save( WWW_ROOT . 'img' . DS . $yearMonth . DS . 'tn-'. $_FILES['filename']['name'] );

        $result = [ 
            'filename' => $yearMonth . DS . $baseFilename,
            'name' => $baseFilename,
            'meta' => json_encode( 
                [
                    'name' => $_FILES['filename']['name'], 
                    'mime' => $_FILES['filename']['type'],
                    'sizes' => $metaFiles 
                ]  
                ) 
            ];
        return( $result  );
    }
}
