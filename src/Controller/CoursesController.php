<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Courses
 *
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
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
        $courses = $this->Courses->find('all',[
            'contain' => ['Authors','Topics'],
        ]);
        $this->loadModel('Lessons');
        foreach ($courses as $course)
        {
            $course->lessons = array();
            $topics = $course->topics;

            foreach ($topics as $topic)
            {
                $lessons = $this->Lessons->find('all',[
                    'conditions'=>['topic_id'=>$topic->id],
                    'order'=>'id'
                ]);

                foreach ($lessons as $lesson) {
                    $course->lessons[] = $lesson->title;
                }
            }
        }
        $this->set(compact('courses'));
    }

    /**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Authors', 'Tags', 'Topics'],
        ]);

        $this->set('course', $course);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $course = $this->Courses->newEntity();
        if ($this->request->is('post')) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if (!empty($this->request->getData('cover')))
            {
                $path = './img/upload/courses';
                $file = $this->upload_file_transfer('cover', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG',$path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $course->cover = $file;
            }
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course').' '.__('has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course').' '.__('could not be saved. Please, try again.'));
        }
        $authors = $this->Courses->Authors->find('list');
        $tags = $this->Courses->Tags->find('list');
        $this->set(compact('course', 'authors', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Tags'],
        ]);
        $actualImage = $course->cover;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($actualImage != $this->request->getData('cover') && !empty($this->request->getData('cover')))
            {
                $path = './img/upload/courses';
                $file = $this->upload_file_transfer('cover', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG', $path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $course->cover = $file;
            }
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course').' '.__('has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course').' '.__('could not be saved. Please, try again.'));
        }
        $authors = $this->Courses->Authors->find('list');
        $tags = $this->Courses->Tags->find('list');
        $this->set(compact('course', 'authors', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        $img = $course->cover;
        if ($this->Courses->delete($course)) {
            if (!empty($img))
            {
                $path = 'img/upload/courses/';
                if (file_exists($path))
                    unlink($path.$img);
                if (file_exists($path.'tb_'.$img))
                    unlink($path.'tb_'.$img);
            }
            $this->Flash->success(__('The course').' '.__('has been deleted.'));
        } else {
            $this->Flash->error(__('The course').' '.__('could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteImage($id)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        $img = $course->cover;
        $course->cover = NULL;

        if ($this->Courses->save($course))
        {
            $path = 'img/upload/courses/';
            if (file_exists($path))
                unlink($path.$img);
            if (file_exists($path.'tb_'.$img))
                unlink($path.'tb_'.$img);
            $this->Flash->success(__('The image has been deleted.'));
        }
        else
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));

        return $this->redirect(['action' => 'edit', $id]);
    }

    /**
     * Tags method
     *
     * @return \Cake\Http\Response|null Redirects on successful tags, renders view otherwise.
     */
    public function tags()
    {
        // The 'pass' key is provided by CakePHP and contains all the passed URL path segments in the request.
        $tags = $this->request->getParam('pass');

        // Use the CoursesTable to find tagged Courses.
        $courses = $this->Courses->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'courses' => $courses,
            'tags' => $tags
        ]);
    }
}
