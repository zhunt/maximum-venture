<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Event\Event;

/**
 * ContentBlocks Controller
 *
 * @property \App\Model\Table\ContentBlocksTable $ContentBlocks
 */
class ContentBlocksController extends AppController
{


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

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contentBlock = $this->ContentBlocks->newEntity();
        if ($this->request->is('post')) {
            $contentBlock = $this->ContentBlocks->patchEntity($contentBlock, $this->request->data);
            if ($this->ContentBlocks->save($contentBlock)) {
                $this->Flash->success('The content block has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The content block could not be saved. Please, try again.');
            }
        }
        $this->set(compact('contentBlock'));
        $this->set('_serialize', ['contentBlock']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Content Block id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contentBlock = $this->ContentBlocks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contentBlock = $this->ContentBlocks->patchEntity($contentBlock, $this->request->data);
            if ($this->ContentBlocks->save($contentBlock)) {
                $this->Flash->success('The content block has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The content block could not be saved. Please, try again.');
            }
        }
        $this->set(compact('contentBlock'));
        $this->set('_serialize', ['contentBlock']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Content Block id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contentBlock = $this->ContentBlocks->get($id);
        if ($this->ContentBlocks->delete($contentBlock)) {
            $this->Flash->success('The content block has been deleted.');
        } else {
            $this->Flash->error('The content block could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
