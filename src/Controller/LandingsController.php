<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

/**
 * Landings Controller
 *
 * @property \App\Model\Table\LandingsTable $Landings
 */
class LandingsController extends AppController
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

       // $numBlogPosts = 12;

        // get list of latest blogs

        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH );

        $this->loadModel('Articles');
        $this->loadModel('Categories');

        // special case if no category passed in
        if ( empty($slug) || $slug == '0' ) {

            $this->paginate = [
                'limit' => 9, // since 3 columns, 12 is good number
                'fields' => ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ],
                'conditions' => [ 'Articles.flag_published' => 1 ],
                'contain' => [  'Categories' => [ 'fields' => ['id', 'name', 'colour', 'text_colour']  ], 
                                'Categories2' => [ 'fields' => ['id', 'name', 'colour', 'text_colour']  ],
                                'ImageUploads' => ['fields' => [ 'filename', 'name', 'file_meta'] ] 
                                ],
                                'order' =>[ 'Articles.created'=>'desc']
            ];            

        }
        else { 

           // debug('here 2');

            $category = $this->Categories->find( 'all', [
                'conditions' => ['Categories.slug' => $slug]
            ])->first();

            $this->paginate = [
                'limit' => 10,
                'fields' => ['id', 'name', 'slug', 'seo_title', 'seo_desc', 'category_id', 'feature_image_id', ],
                'contain' => [  'Categories' => ['conditions' => ['Articles.category_id' => $category->id ], 'fields' => ['id', 'name']  ], 
                                /* 'ImageUploads' => ['fields' => [ 'filename', 'file_meta'] ] */
                                ]
            ];
        }

        $this->set('articles', $this->paginate($this->Articles));
        $this->set('_serialize', ['articles']);


        $this->set('canonical', Configure::read('siteUrlFull') ); 

        
        
        //$this->set('landings', $this->paginate($this->Landings));
        //$this->set('_serialize', ['landings']);
    }


}
