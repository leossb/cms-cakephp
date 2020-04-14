<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons
 *
 * @method \App\Model\Entity\Lesson[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonsController extends AppController
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
    public function index($course_id = null)
    {
        $lessons = $this->Lessons->find('all',[
            'contain' => ['Topics']
        ]);
        if (!is_null($course_id))
        {
            $lessons->where(['Topics.course_id'=>$course_id]);
        }
        $this->set(compact('lessons'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lesson = $this->Lessons->get($id, [
            'contain' => ['Topics'],
        ]);

        $this->set('lesson', $lesson);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lesson = $this->Lessons->newEntity();
        if ($this->request->is('post')) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if (!empty($this->request->getData('cover')))
            {
                $path = './img/upload/lessons';
                $file = $this->upload_file_transfer('cover', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG',$path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $lesson->cover = $file;
            }
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson').' '.__('has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson').' '.__('could not be saved. Please, try again.'));
        }
        $topics = $this->Lessons->Topics->find('list');
        $this->set(compact('lesson', 'topics'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lesson = $this->Lessons->get($id, [
            'contain' => [],
        ]);
        $actualImage = $lesson->cover;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($actualImage != $this->request->getData('cover') && !empty($this->request->getData('cover')))
            {
                $path = './img/upload/lessons';
                $file = $this->upload_file_transfer('cover', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG', $path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $lesson->cover = $file;
            }
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson').' '.__('has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson').' '.__('could not be saved. Please, try again.'));
        }
        $topics = $this->Lessons->Topics->find('list');
        $this->set(compact('lesson', 'topics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lesson = $this->Lessons->get($id);
        $img = $lesson->cover;
        if ($this->Lessons->delete($lesson)) {
            if (!empty($img))
            {
                $path = 'img/upload/lessons/';
                if (file_exists($path))
                    unlink($path.$img);
                if (file_exists($path.'tb_'.$img))
                    unlink($path.'tb_'.$img);
            }
            $this->Flash->success(__('The lesson').' '.__('has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson').' '.__('could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteImage($id)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $lesson = $this->Lessons->get($id);
        $img = $lesson->cover;
        $lesson->cover = NULL;

        if ($this->Lessons->save($lesson))
        {
            unlink('img/upload/lessons/'.$img);
            $this->Flash->success(__('The image has been deleted.'));
        }
        else
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));

        return $this->redirect(['action' => 'edit', $id]);
    }
}
