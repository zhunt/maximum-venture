<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Schools Controller
 *
 * @property \App\Model\Table\SchoolsTable $Schools
 */
class SchoolsController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [ 'Cities']
        ];
        $this->set('schools', $this->paginate($this->Schools)); //debug($this->Schools->Cities->name);
        $this->set('_serialize', ['schools']);
    }

    /**
     * View method
     *
     * @param string|null $id School id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => [ 'Chains', 'Cities']
        ]);
        $this->set('school', $school);
        $this->set('_serialize', ['school']);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $school = $this->Schools->newEntity();
        if ($this->request->is('post')) {
            $school = $this->Schools->patchEntity($school, $this->request->data);
            if ($this->Schools->save($school)) {
                $this->Flash->success('The school has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The school could not be saved. Please, try again.');
            }
        }
        $imageUploads = $this->Schools->ImageUploads->find('list', ['limit' => 200]);
        $chains = $this->Schools->Chains->find('list', ['limit' => 200]);
        $cities = $this->Schools->Cities->find('list', ['limit' => 200]);
        $this->set(compact('school', 'imageUploads', 'chains', 'cities'));
        $this->set('_serialize', ['school']);
    }

    /**
     * Edit method
     *
     * @param string|null $id School id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $school = $this->Schools->patchEntity($school, $this->request->data);
            if ($this->Schools->save($school)) {
                $this->Flash->success('The school has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The school could not be saved. Please, try again.');
            }
        }
        $imageUploads = $this->Schools->ImageUploads->find('list', ['limit' => 200]);
        $chains = $this->Schools->Chains->find('list', ['limit' => 200]);
        $cities = $this->Schools->Cities->find('list', ['limit' => 200]);
        $this->set(compact('school', 'imageUploads', 'chains', 'cities'));
        $this->set('_serialize', ['school']);
    }

    /**
     * Delete method
     *
     * @param string|null $id School id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $school = $this->Schools->get($id);
        if ($this->Schools->delete($school)) {
            $this->Flash->success('The school has been deleted.');
        } else {
            $this->Flash->error('The school could not be deleted. Please, try again.');
        }
        return $this->redirect(['action' => 'index']);
    }
}
