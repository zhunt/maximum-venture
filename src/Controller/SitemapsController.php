<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

use Cake\Core\Configure;

use Cake\Network\Request;

/**
 * Sitemaps Controller
 *
 * @property \App\Model\Table\SitemapsTable $Sitemaps
 */
class SitemapsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow();
    } 

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
       // $this->RequestHandler->renderAs($this, 'xml');

        $this->loadModel('Articles');

    if ($this->RequestHandler->isXml() ) {
        $articles = $this->Articles
            ->find()
            ->limit(500)
            ->order(['created' => 'desc']);
        $this->set(compact('articles'));
    }        
/*
        if($this->request->is('xml')) {
            $this->viewBuilder()->layout('xml');

            $articles = $this->Articles->find('all')->where([ 'Articles.flag_published' => 1 ])->order(['Articles.created' => 'desc'])->limit(20);

            $this->set('_serialize', ['articles'] );  

        } else { 
            $this->viewBuilder()->layout(false);    
       
       // $sitemaps = $this->paginate($this->Sitemaps);

        $this->paginate = [
            'contain' => [],
            'fields' => ['id', 'name', 'slug', 'feature_text', 'created' ],
            'limit' => 5,
            'conditions' => [ 'Articles.flag_published' => 1 ],
            'order' => ['Articles.created' => 'desc']
        ];

        $this->set('articles', $this->paginate($this->Articles));
        $this->set('_serialize', true );        
    }

*/

       // $this->set(compact('sitemaps'));
       // $this->set('_serialize', ['sitemaps']);
    }

    /**
     * View method
     *
     * @param string|null $id Sitemap id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sitemap = $this->Sitemaps->get($id, [
            'contain' => []
        ]);

        $this->set('sitemap', $sitemap);
        $this->set('_serialize', ['sitemap']);
    }

}
