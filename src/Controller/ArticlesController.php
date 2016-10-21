<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;


use Cake\Cache\Cache;

use Cake\Network\Exception\NotFoundException;

use League\CommonMark\CommonMarkConverter;

use Cake\Mailer\Email;




/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{



    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Csrf');
    }

   



    public function beforeFilter(Event $event)
    {
        $this->Auth->allow();

        //$this->Security->requireSecure();

         //$this->viewBuilder()->layout('admin_default');
    } 


    /**
     * Index method
     *
     * @return void
     */
    public function index( $id = 0)
    {
        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $metaNoFollow = false;

        $this->loadModel('Categories');
        // special case if no category passed in
        if ( $slug == '0' ) { 

            throw new NotFoundException(__('No category passed in'));
                       
            /*
                $this->paginate = [
                    'limit' => 12,
                    'fields' => ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ],
                    'conditions' => [ 'Articles.flag_published' => 1 ],
                    'contain' => [  'Categories' => [ 'fields' => ['id', 'name', 'colour']  ], 
                                    'Categories2' => [ 'fields' => ['id', 'name', 'colour']  ],
                                    'ImageUploads' => ['fields' => [ 'filename', 'file_meta'] ] 
                                    ],
                                    'order' =>[ 'Articles.created'=>'desc']
                ];  

                // set to empty, so doesn't trigger error on view
                $this->set('canonical', Configure::read('siteUrlFull') . '/' );
                $this->set('categoryName', '' );
            */
        }
        else { 

           

            $slug = strtolower($slug);

            $category = $this->Categories->find( 'all', [
                'conditions' => ['Categories.slug' => $slug]
            ])->first();

            if (empty($category) ) {
                throw new NotFoundException( 'Category not found : ' . $slug );
            }

            $this->paginate = [
                'limit' => 12,
                'fields' => ['id', 'name', 'slug', 'feature_text', 'category_id', 'category_id_2', 'feature_image_id', 'created' ],

                'conditions' => [ 
                    'Articles.flag_published' => 1,
                    'OR' => [   ['Articles.category_id' => $category->id], 
                                ['Articles.category_id_2' => $category->id] ],
                    ],   
                'contain' => [  'Categories' => [ 'fields' => ['id', 'name', 'colour']  ], 
                                'Categories2' => [ 'fields' => ['id', 'name', 'colour']  ],
                                'ImageUploads' => ['fields' => [ 'filename', 'file_meta'] ] 
                                ],
                                'order' =>[ 'Articles.created'=>'desc']
            ];  

        }

        if ( empty($category->description) ){
            $this->set('metaNoFollow', true); 
        }else{
            $this->set('metaNoFollow', false); 
        }

        $this->set('categoryName',  $category->name );
        $this->set('category',  $category );
        $this->set('canonical', Configure::read('siteUrlFull') . '/category/' . $slug .'/' );
                    
        $this->set('articles', $this->paginate($this->Articles));
        $this->set('_serialize', ['articles']);
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $slug = filter_var($id, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW|FILTER_FLAG_ENCODE_HIGH ); 

        $article = $this->Articles->find( 'all', [
            'conditions' => ['Articles.slug' => $slug],
            'contain' => ['Categories', 'Categories2', 'ImageUploads', 'Tags' => ['Companies'] ]
        ])->first();

        // error thrown if not found  
        if (!$article) {
            throw new NotFoundException();
        }           

        $canonical = Configure::read('siteUrlFull') . '/article/' . $article->slug;

        $tagsList = $article->tags; 

        $companiesList = [];
        foreach( $tagsList as $company){
            if ( isset($company['company']) ){
                //debug($company['company']);

                //debug( $company['company']->id );
                $company['company']->description = $this->getCompanyProfile($company['company']->id, $company['company']->description );

                $companiesList[] = [ 'name' => $company['company']->name, 'description' => $company['company']->description  ];

            }
        }

        //debug($companiesList); 

        $article->body = $this->getMarkdownText($article->id, $article->body );
        
        $this->set('companiesList', $companiesList);
        $this->set('article', $article);
        $this->set('canonical', $canonical );
        $this->set('_serialize', ['article']);
    }

    public function getMarkdownText($id, $rawText)
    {
        return Cache::remember( 'article-text-' . $id   , function () use ($rawText) {
            //return $this->fetchAll($repo);
            $converter = new CommonMarkConverter();
            return $converter->convertToHtml($rawText);
        });
    }    

    public function getCompanyProfile($id, $rawText)
    {
        return Cache::remember( 'company-text-' . $id   , function () use ($rawText) {
            //return $this->fetchAll($repo);
            $converter = new CommonMarkConverter();
            return $converter->convertToHtml($rawText);
        });
    }  


    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
/*
            $recaptcha = new \ReCaptcha\ReCaptcha( Configure::read('googleSecretKey') );

            $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()){
                echo 'all good';
            }else {
                foreach ($resp->getErrorCodes() as $code) {
                        echo '<tt>' , $code , '</tt> ';
                    }
                    exit;
            } 
*/


            $article = $this->Articles->patchEntity($article, $this->request->data, [ 'validate' => 'UserStory' ]);
            //debug($article->errors());
            if ($this->Articles->save($article)) {

                // send message

                $sender = Configure::read('adminEmail');
                $websiteName = Configure::read('websiteName'); 

                // Sample smtp configuration. unsequred SMTP server
                Email::configTransport('server', [
                    'host' => 'mail.maximumventure.ca',
                    'port' => 25,
                    'username' => Configure::read('adminEmail'),
                    'password' => Configure::read('adminEmailPw'),
                    'className' => 'Smtp',
                   // 'tls' => true
                ]);

                $email = new Email(['from' => $sender, 'transport' => 'server']);

                $editLink = Configure::read('siteUrlFull') .'/admin/articles/edit/' . $article->id . '/';
                $emailMessage = "An Article Has Been Submitted:\n{$article->name}\n\nBy: {$article->author}/{$article->url}\n\nView here: {$editLink}";
                //debug($emailMessage);
                
                $email->from([$sender => $websiteName  ])
                    ->to('zhunt@yyztech.ca')
                    ->subject('New Article Submitted to ' . $websiteName )
                    ->send($emailMessage);


                $this->Flash->success(__('Thank You. Your Story Has Been Submitted.'));
               // return $this->redirect([ 'url' => '/']);
            } else {
                $this->Flash->error(__('Please Correct Errors.'));
            }
        }
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $imageUploads = $this->Articles->ImageUploads->find('list', ['limit' => 200]);

        $this->set('googleKey', Configure::read('googleSiteKey') );
        $this->set(compact('article', 'categories', 'imageUploads'));
        $this->set('_serialize', ['article']);
    }


   
    // helpers
    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all
        // the passed URL path segments in the request.
        $tags = $this->request->params['pass'];

        // Use the BookmarksTable to find tagged bookmarks.
        $bookmarks = $this->Article->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'bookmarks' => $bookmarks,
            'tags' => $tags
        ]);
    }

}
