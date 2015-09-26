<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

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
            'contain' => ['Categories']
        ];
        $this->set('articles', $this->paginate($this->Articles));
        $this->set('_serialize', ['articles']);
    }

        public function load(){
        $this->loadComponent('WpRest');

        $result = $this->WpRest->getRecentPosts(3); 
       // debug($data);
        //$this->set('_serialize', ['articles']);


        // save
        //$articlesTable = TableRegistry::get('Articles');
        //$author = $articlesTable->Authors->findByUserName('mark')->first();

        foreach( $result as $i => $data) { debug($data);

            $article = $this->Articles->newEntity();

            $record = $this->Articles->findBySlug( $data['slug'] )->first();

            if ( isset($record->id)) $article->id = $record->id;
            debug($record); 

            



            $article->name = $data['name'];
            $article->slug = $data['slug'];
            $article->feature_image = $data['feature_image'];
            $article->body = $data['body'];
            $article->tags = "none";
            $article->categories = 1;

            //$article->created = $data['data'];
           

            if ( $this->Articles->save($article) ) {
                // The foreign key value was set automatically.
                //echo $article->author_id;
            }

        }

        /*
    (int) 0 => [
        'id' => (int) 14,
        'name' => 'BlackBerry’s $425-million Good Technology deal not without concerns',
        'slug' => 'blackberrys-425-million-good-technology-deal-not-without-concerns',
        'date' => '2015-09-04T19:23:06',
        'feature_image' => null,
        'body' => '<p class="selectionShareable">BlackBerry Inc. CEO John Chen almost executed the rare corporate trifecta on Friday, buying out a troublesome rival, bolstering his management team’s plan for a turnaround and gaining a nice little bump in the share price too.</p>
<p class="selectionShareable">As it turned out, the bump in shares was temporary, and the stock closed down 20 cents at $9.66 on the TSX.</p>
<p class="selectionShareable"><!--more--></p>
<p class="selectionShareable">BlackBerry’s $425-million (U.S.) deal to swallow up Good Technology – a Sunnyvale, Calif., rival in the enterprise mobile management (EMM) market – is also the largest acquisition in its corporate history. The next closest deal was the 2010 pact to buy QNX for $200-million, the connected-car platform that then became the core of the BB10 operating system.</p>
<p class="selectionShareable">On its face, Good Technology, a company previously known for sniping at and competing with BlackBerry, seems like a good fit. Mr. Chen wins back some of the defence and financial industry customers that abandoned BlackBerry hardware and software in recent years, and Good Technology customers gain access to BlackBerry’s suite of professional security services.</p>
<p class="selectionShareable">“ Good, with its customer base of 6,200 organizations, has been a leader in EMM for quite some time, as evidenced by Gartner’s rating of Good as a “Leader” in its magic quadrant for EMM in June, 2015 (versus a “Niche Player” rating for BlackBerry),” Morningstar’s Brian Collelo wrote in a research note.</p>
<p class="selectionShareable">But there are some concerns about the complexity of the platforms. The combined entity will have to manage at least four fairly different EMM customer bases: BlackBerry has struggled to convert its Enterprise Server customers with legacy BB7 devices to its newer cross-platform service, while Good Technology also has older clients stuck on “Good for Enterprise” who have yet to jump to its newer “Good Work” apps.</p>
',
        'tags' => [
            'blackberry' => 'BlackBerry',
            'good-technology' => 'Good Technology'
        ],
        'categories' => [
            'information-and-cultural-industries' => 'Information and cultural industries'
        ]
    ]


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
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $this->set(compact('article', 'categories'));
        $this->set('_serialize', ['article']);
        */

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
            'contain' => ['Categories', 'Tags']
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
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'categories', 'tags'));
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
        if ($this->request->is(['patch', 'post', 'put'])) { debug( $this->request->data); exit;
            $article = $this->Articles->patchEntity($article, $this->request->data);
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The article could not be saved. Please, try again.'));
            }
        }
        $categories = $this->Articles->Categories->find('list', ['limit' => 200]);
        $tags = $this->Articles->Tags->find('list', ['limit' => 200]);
        $this->set(compact('article', 'categories', 'tags'));
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
