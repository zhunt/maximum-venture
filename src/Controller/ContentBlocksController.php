<?php
namespace App\Controller;

use App\Controller\AppController;

use Cake\Event\Event;

/**
 * ContentBlocks Controller
 *
 * @property \App\Model\Table\ContentBlocksTable $ContentBlocks
 */
class ContentBlocksController extends AppController
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
        $this->set('contentBlocks', $this->paginate($this->ContentBlocks));
        $this->set('_serialize', ['contentBlocks']);
    }

    /**
     * View method
     *
     * @param string|null $id Content Block id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contentBlock = $this->ContentBlocks->get($id, [
            'contain' => []
        ]);
        $this->set('contentBlock', $contentBlock);
        $this->set('_serialize', ['contentBlock']);
    }

}
