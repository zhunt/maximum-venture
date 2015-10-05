<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\I18n\Time;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 */
class ArticlesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Categories']
        ];
        $this->set('articles', $this->paginate($this->Articles));
        $this->set('_serialize', ['articles']);
    }



    public function load(){
        $this->loadComponent('WpRest');

        $result = $this->WpRest->getRecentPosts(12); 

        foreach( $result as $i => $data) { //debug($data);

            $article = $this->Articles->newEntity();


            $result = $this->Articles->findBySlug( $data['slug'] )->first();

            if ( isset($result->id)) $article->id = $result->id;

            //save tags
            $tagIds = $this->Articles->Tags->updateTags($data['tags']);
            debug($tagIds); //exit;
            $categoryIds = $this->Articles->Categories->updateCategories($data['categories']);
           //debug($categoryIds);

            
            //debug( Time::createFromTimeStamp( strtotime($data['date']) ) ); // '2015-09-04T19:23:06'
/*
            $article->user_id = 1;
            $article->name = $data['name'];
            $article->slug = $data['slug'];
            $article->feature_image = $data['feature_image'];
            $article->body = $data['body'];
            $article->tags = $tagIds;
            $article->published = 1;
            $article->category_id = 1;
            $article->created = Time::createFromTimeStamp( strtotime($data['date']) ); // WP: 2015-08-25 19:49:30
*/
            $newData = [
                'user_id' => 1,
                'name' => $data['name'],
                'slug' => $data['slug'],
                'feature_image' => $data['feature_image'],
                'published' => 1,
                'body' => $data['body'],
                'category_id' => $categoryIds[0], // just get the first one
                'created' => Time::createFromTimeStamp( strtotime($data['date']) ),
                'tags' => [
                    '_ids' => $tagIds
                ]
            ];

            
           // $article->id = $result->id;
            $article = $this->Articles->patchEntity($article, $newData,  ['validate' => false]); //debug($article);
            $this->Articles->save($article);


           
         // debug( $article ); 
           // if ( $this->Articles->save($article) ) {
                // The foreign key value was set automatically.
                //echo $article->author_id;
           // }

        }
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
        $article = $this->Articles->get($id, [
            'contain' => ['Users', 'Categories', 'Tags']
        ]);
        $this->set('article', $article);
        $this->set('_serialize', ['article']);
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
            $article = $this->Articles->patchEntity($article, $this->request->data); 
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $this->set('article', $article);
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        //$categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('treeList');
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users', 'categories', 'tags'));
        $this->set('_serialize', ['article']);
    }


    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->data); debug($this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $users = $this->Articles->Users->find('list', ['limit' => 200]);
        //$categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $categories = $this->Articles->Categories->find('treeList');

        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'users', 'categories', 'tags'));
        $this->set('_serialize', ['article']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->Flash->success(__('The article has been deleted.'));
        } else {
            $this->Flash->error(__('The article could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
