<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PgsLists Controller
 *
 * @property \App\Model\Table\PgsListsTable $PgsLists
 *
 * @method \App\Model\Entity\PgsList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PgsListsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
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
        $pgsLists = $this->PgsLists->find('all',[
            'contain' => ['Pgs'],
        ]);
        $this->set(compact('pgsLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Pgs List id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $pgsList = $this->PgsLists->get($id, [
            'contain' => ['Pgs'],
        ]);
        $this->set('pgsList', $pgsList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($pg_id)
    {
        $pgsList = $this->PgsLists->newEntity();
        if ($this->request->is('post')) {
            $pgsList = $this->PgsLists->patchEntity($pgsList, $this->request->getData());
            if (!empty($this->request->getData('image')))
            {
                $path = './img/upload/pgs_lists';
                $file = $this->upload_file_transfer('image', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG',$path, 'nao', '200000', 'nao');
                if (!empty($file))
                {
                    $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                    $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                }
                $pgsList->image = $file;
            }
            if ($this->PgsLists->save($pgsList)) {
                $this->Flash->success(__('The pages list').' '.__('has been saved.'));
                return $this->redirect(['controller'=>'Pgs','action'=>'edit',$pg_id]);
            }
            $this->Flash->error(__('The pages list').' '.__('could not be saved. Please, try again.'));
        }
        $pg_name = $this->PgsLists->Pgs->get($pg_id)->name;
        $this->set(compact('pgsList', 'pg_id', 'pg_name'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pgs List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pgsList = $this->PgsLists->get($id, [
            'contain' => ['Pgs'],
        ]);
        $pg_id = $pgsList->pg->id;
        $actualImage = $pgsList->image;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pgsList = $this->PgsLists->patchEntity($pgsList, $this->request->getData());
            if ($actualImage != $this->request->getData('image') && !empty($this->request->getData('image')))
            {
                $path = './img/upload/pgs_lists';
                $file = $this->upload_file_transfer('image', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG', $path, 'nao', '200000', 'nao');
                if (!empty($file))
                {
                    $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                    $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                }
                $pgsList->image = $file;
            }
            if ($this->PgsLists->save($pgsList)) {
                $this->Flash->success(__('The pages list').' '.__('has been saved.'));
                return $this->redirect(['controller'=>'Pgs','action'=>'edit',$pg_id]);
            }
            $this->Flash->error(__('The pages list').' '.__('could not be saved. Please, try again.'));
        }
        $pg_name = $this->PgsLists->Pgs->get($pg_id)->name;
        $this->set(compact('pgsList', 'pg_id', 'pg_name'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pgs List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pgsList = $this->PgsLists->get($id);
        $pg_id = $pgsList->pg_id;
        if ($this->PgsLists->delete($pgsList))
            $this->Flash->success(__('The pages list').' '.__('has been deleted.'));
        else
            $this->Flash->error(__('The pages list').' '.__('could not be deleted. Please, try again.'));
        return $this->redirect(['controller'=>'Pgs','action'=>'edit',$pg_id]);
    }
}
