<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Utility\Hash;

use Cake\Network\Request;

use Cake\Network\Exception\NotFoundException;

/**
 * Searches Controller
 *
 * @property \App\Model\Table\SearchesTable $Searches
 */
class SearchesController extends AppController
{

    public function beforeFilter(Event $event)
    {
         $this->Auth->allow();
    }     


    public function tagSearch($id)
    {

        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $tags = trim($slug);

        $metaNoFollow = true;

        $this->loadModel('Articles');

        $this->loadModel('Tags');

        $tag = $this->Tags->find('all')->where(['Tags.slug' => $slug])->contain(['Companies'])->first();
        if (empty($tag) ) {
            throw new NotFoundException(__('Tag not found'));
        }
//debug($tag);
        // Use the BookmarksTable to find tagged bookmarks.
        $bookmarks = $this->Articles->find('tagged', [
            'tags' => $tags
        ])->toArray();


        if ( isset( $bookmarks[0]['_matchingData']['Tags']['title']) ) {
            $tagName = $bookmarks[0]['_matchingData']['Tags']['title'];
        }else {
            $tagName = $slug;
        }

        $bookmarks = Hash::extract($bookmarks, '{n}.id');

        $this->paginate = [
                'limit' => 12,
                'fields' => ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ],
                'conditions' => [ 'Articles.flag_published' => 1, 'Articles.id IN' => $bookmarks ], // 
                'contain' => [  'Categories' => [ 'fields' => ['id', 'name', 'colour']  ], 
                                'Categories2' => [ 'fields' => ['id', 'name', 'colour']  ],
                                'ImageUploads' => ['fields' => [ 'filename', 'name', 'file_meta'] ] 
                                ],
                                'order' =>[ 'Articles.created'=>'desc']
        ];  


        if ( empty($tag->description) || ( $tag->company_id < 1) ){
            $this->set('metaNoFollow', true);
        }else{
            $this->set('metaNoFollow', false);
        }       

        $this->set('tagName',  $tag->title );

        $articles = $this->paginate( $this->Articles );

        $this->set(compact('articles', 'tag'));
        $this->set('_serialize', ['articles']);

        $this->set('canonical', Configure::read('siteUrlFull') . '/tag/' . $tag->slug .'/' ); 

      
       //debug($articles);
    }


    public function textSearch() {

        $searchString = $this->request->query('search');

        $searchString = filter_var( $searchString, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $metaNoFollow = true;

        $this->loadModel('Articles');


        $query = $this->Articles->find()
                ->select( ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ] )
                ->contain([
                    'Tags',
                    'Categories' => [ 'fields' => ['id', 'name', 'colour']  ], 
                    'Categories2' => [ 'fields' => ['id', 'name', 'colour']  ],
                    'ImageUploads' => ['fields' => [ 'filename', 'name', 'file_meta'] ] 

                    ])
                ->where([
                    'Articles.flag_published' => 1,
                    'OR' => [
                        
                        "MATCH(Articles.name , Articles.body) AGAINST(:search IN NATURAL LANGUAGE MODE)",
                        //"MATCH(Articles.name) AGAINST(:search IN NATURAL LANGUAGE MODE)"
                    ]
                ])
                ->limit(3)
                ->bind(':search', $searchString);



        $this->paginate = [ 'limit' => 12 ];

        $articles = $this->paginate($query ); // test


        //debug ( $query->toArray() );

        $this->set('metaNoFollow', true);       

        $this->set('tagName',  $searchString );     

        // $articles = $this->paginate( $this->Articles ); // take out temp

        $this->set(compact('articles'));
        $this->set('_serialize', ['articles']);          
        
              



    }


}
