<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
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
        $comments = $this->Comments->find('all',[
            'contain' => ['Users','Articles'],
        ]);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('comment', $comment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment').' '.__(' has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment').' '.__(' could not be saved. Please, try again.'));
        }
        $users = $this->Comments->Users->find('list');
        $articles = $this->Comments->Articles->find('list');
        $this->set(compact('comment', 'users','articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment').' '.__(' has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment').' '.__(' could not be saved. Please, try again.'));
        }
        $users = $this->Comments->Users->find('list');
        $articles = $this->Comments->Articles->find('list');
        $this->set(compact('comment', 'users', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment').' '.__(' has been deleted.'));
        } else {
            $this->Flash->error(__('The comment').' '.__(' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
