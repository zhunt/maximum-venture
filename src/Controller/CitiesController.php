<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Parsedown;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
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
    public function index()
    {
        $this->paginate = [
            'limit' => 10,
            'contain' => ['Provinces', 'Countries']
        ];
        $this->set('cities', $this->paginate($this->Cities));
        $this->set('_serialize', ['cities']);
        /*
    public function index( $id = 0)
    {
        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $this->loadModel('Categories');
        $category = $this->Categories->find( 'all', [
            'conditions' => ['Categories.slug' => $slug]
        ])->first();

        $this->paginate = [
            'limit' => 10,
            'fields' => ['id', 'name', 'slug', 'seo_title', 'seo_desc', 'category_id', 'feature_image_id', ],
            'contain' => [  'Categories' => ['conditions' => ['Articles.category_id' => $category->id ], 'fields' => ['id', 'name']  ], 
                            'ImageUploads' => ['fields' => [ 'filename', 'file_meta'] ] 
                            ]
        ];

        $this->set('articles', $this->paginate($this->Articles));
        $this->set('_serialize', ['articles']);
    }
        */
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {

        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $city = $this->Cities->find( 'all', [
            'conditions' => ['Cities.slug' => $slug],
            'contain' => [
                'Provinces' => ['fields' => ['name'] ], 
                'Countries' => ['fields' => ['name'] ], 
                'Schools' =>['ImageUploads' => ['fields' => ['file_meta'] ], 
                    'fields' => ['name', 'slug', 'city_id', 'address', 'logo_id'] ] 
                ]
        ])->first();

        if (!$city) {
            throw new NotFoundException();
        }        

        $canonical = Configure::read('siteUrlFull') . '/city/' . $city->slug;

        $cityText = $city->city_text;

        if( !empty($cityText)){
            $cityText = Parsedown::instance()->text($cityText);
            $city->city_text = $cityText;
        }

      //debug($city);
        $this->set('city', $city);
        $this->set('canonical', $canonical );
        $this->set('_serialize', ['city']);
    }

   
}
