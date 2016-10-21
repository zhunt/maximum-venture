<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Provinces Controller
 *
 * @property \App\Model\Table\ProvincesTable $Provinces
 */
class ProvincesController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries']
        ];
        $this->set('provinces', $this->paginate($this->Provinces));
        $this->set('_serialize', ['provinces']);
    }

    /**
     * View method
     *
     * @param string|null $id Province id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $province = $this->Provinces->get($id, [
            'contain' => ['Countries', 'Cities']
        ]);
        $this->set('province', $province);
        $this->set('_serialize', ['province']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $province = $this->Provinces->newEntity();
        if ($this->request->is('post')) {
            $province = $this->Provinces->patchEntity($province, $this->request->data);
            if ($this->Provinces->save($province)) {
                $this->Flash->success('The province has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The province could not be saved. Please, try again.');
            }
        }
        $countries = $this->Provinces->Countries->find('list', ['limit' => 200]);
        $this->set(compact('province', 'countries'));
        $this->set('_serialize', ['province']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Province id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $province = $this->Provinces->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $province = $this->Provinces->patchEntity($province, $this->request->data);
            if ($this->Provinces->save($province)) {
                $this->Flash->success('The province has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The province could not be saved. Please, try again.');
            }
        }
        $countries = $this->Provinces->Countries->find('list', ['limit' => 200]);
        $this->set(compact('province', 'countries'));
        $this->set('_serialize', ['province']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Province id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $province = $this->Provinces->get($id);
        if ($this->Provinces->delete($province)) {
            $this->Flash->success('The province has been deleted.');
        } else {
            $this->Flash->error('The province could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
