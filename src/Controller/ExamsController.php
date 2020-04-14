<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Exams Controller
 *
 * @property \App\Model\Table\ExamsTable $Exams
 *
 * @method \App\Model\Entity\Exam[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExamsController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadComponent('Flash');
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
            'contain' => ['Topics'],
        ];
        $exams = $this->paginate($this->Exams);

        $this->set(compact('exams'));
    }

    /**
     * View method
     *
     * @param string|null $id Exam id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exam = $this->Exams->get($id, [
            'contain' => ['Topics', 'Questions'],
        ]);

        $this->set('exam', $exam);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exam = $this->Exams->newEntity();
        if ($this->request->is('post')) {
            $exam = $this->Exams->patchEntity($exam, $this->request->getData());
            if ($this->Exams->save($exam)) {
                $this->Flash->success(__('The exam').' '.__(' has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam').' '.__(' could not be saved. Please, try again.'));
        }
        $topics = $this->Exams->Topics->find('list', ['limit' => 200]);
        $this->set(compact('exam', 'topics'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Exam id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exam = $this->Exams->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $exam = $this->Exams->patchEntity($exam, $this->request->getData());
            if ($this->Exams->save($exam)) {
                $this->Flash->success(__('The exam').' '.__(' has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exam').' '.__(' could not be saved. Please, try again.'));
        }
        $topics = $this->Exams->Topics->find('list', ['limit' => 200]);
        $this->set(compact('exam', 'topics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Exam id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exam = $this->Exams->get($id);
        if ($this->Exams->delete($exam)) {
            $this->Flash->success(__('The exam').' '.__(' has been deleted.'));
        } else {
            $this->Flash->error(__('The exam').' '.__(' could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
