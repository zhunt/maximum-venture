<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Core\Configure;

use Cake\Event\Event;

use Cake\Network\Exception\NotFoundException;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 */
class CategoriesController extends AppController
{

    public function beforeFilter(Event $event)
    {
       $this->Auth->allow();
    }     

    /**
     * Index method
     *
     * @return void
     */
    public function index($id = null)
    {
      
//-----

        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH );

        $this->loadModel('Articles');
        $this->loadModel('Categories');

        // special case if no category passed in
        if ( empty($slug) || $slug == '0' ) {

            $this->paginate = [
                'limit' => 10,
                'fields' => ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ],
                'contain' => [  'Categories' => [ 'fields' => ['id', 'name', 'colour']  ], 
                                'Categories2' => [ 'fields' => ['id', 'name', 'colour']  ],
                                'ImageUploads' => ['fields' => [ 'filename', 'name', 'file_meta'] ] 
                                ],
                                'order' =>[ 'Articles.created'=>'desc']
            ];            

        }
        else { 

            debug('here 2');

            $category = $this->Categories->find( 'all', [
                'conditions' => ['Categories.slug' => $slug]
            ])->first();

            $this->paginate = [
                'limit' => 10,
                'fields' => ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ],
                'contain' => [  'Categories' => [ 'fields' => ['id', 'name', 'colour']  ], 
                                'Categories2' => [ 'fields' => ['id', 'name', 'colour']  ],
                                'ImageUploads' => ['fields' => [ 'filename', 'file_meta'] ] 
                                ],
                                'order' =>[ 'Articles.created'=>'desc']
            ];    


        }


//-----        

        $this->paginate = [
            'contain' => ['Articles']
        ];        
        $this->set('categories', $this->paginate($this->Categories));
        $this->set('_serialize', ['categories']);
    }


    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); debug($slug);

       
        
        $article = $this->Categories->find( 'all', [
            'conditions' => ['Categories.slug' => $slug],
            //'contain' => ['Categories']
        ])->first();

        /*
        $category = $this->Categories->get($id, [
            'contain' => ['Articles']
        ]);
        */

        $this->paginate = [
            'contain' => ['Articles']
        ];        
        $this->set('categories', $this->paginate($this->Categories));
        $this->set('_serialize', ['categories']);

        $this->set('canonical', Configure::read('siteUrlFull') . '/category' ); // add category here! 

/*
        $this->set('category', $category);
        $this->set('_serialize', ['category']);
  */      
    }

}
