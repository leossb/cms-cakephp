<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Pgs Controller
 *
 * @property \App\Model\Table\PgsTable $Pgs
 *
 * @method \App\Model\Entity\Pg[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PgsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['tags']);
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
        $this->viewBuilder()->setLayout('admin');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'ParentPgs'],
        ];
        $pgs = $this->paginate($this->Pgs);

        $this->set(compact('pgs'));
    }

    /**
     * View method
     *
     * @param string|null $id Pg id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pg = $this->Pgs->get($id, [
            'contain' => ['Users', 'ParentPgs', 'ChildPgs'],
        ]);

        $this->set('pg', $pg);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pg = $this->Pgs->newEntity();
        if ($this->request->is('post')) {
            $pg = $this->Pgs->patchEntity($pg, $this->request->getData());
            if ($this->Pgs->save($pg)) {
                $this->Flash->success(__('The pg has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pg could not be saved. Please, try again.'));
        }
        $users = $this->Pgs->Users->find('list', ['limit' => 200]);
        $parentPgs = $this->Pgs->ParentPgs->find('list', ['limit' => 200]);
        $this->set(compact('pg', 'users', 'parentPgs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pg id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pg = $this->Pgs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pg = $this->Pgs->patchEntity($pg, $this->request->getData());
            if ($this->Pgs->save($pg)) {
                $this->Flash->success(__('The pg has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pg could not be saved. Please, try again.'));
        }
        $users = $this->Pgs->Users->find('list', ['limit' => 200]);
        $parentPgs = $this->Pgs->ParentPgs->find('list', ['limit' => 200]);
        $this->set(compact('pg', 'users', 'parentPgs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pg id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pg = $this->Pgs->get($id);
        if ($this->Pgs->delete($pg)) {
            $this->Flash->success(__('The pg has been deleted.'));
        } else {
            $this->Flash->error(__('The pg could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}