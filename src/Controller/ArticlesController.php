<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Articles Controller
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['tags']);
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
        $articles = $this->Articles->find('all',[
            'contain'=>['Users']
        ]);
        $this->set(compact('articles'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($article)
    {
        if (is_numeric($article))
            $article = $this->Articles->get($article,['contain' => ['Users', 'Tags']]); // Get id
        else
            $article = $this->Articles->findBySlug($article)->contain(['Users','Tags'])->firstOrFail(); // Slug

        $this->set(compact('article'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $article = $this->Articles->newEntity();
        if ($this->request->is('post')) {
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            if (!empty($this->request->getData('cover')))
            {
                $path = './img/upload/articles';
                $file = $this->upload_file_transfer('cover', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG',$path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $article->cover = $file;
            }
            $article->user_id = $this->Auth->user('id');
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article').' '.__('has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article').' '.__('could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list');
        $tags = $this->Articles->Tags->find('list');
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('article', 'users', 'tags','categories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $article = $this->Articles->get($id, [
            'contain' => ['Tags'],
        ]);
        $actualImage = $article->cover;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $article = $this->Articles->patchEntity($article, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($actualImage != $this->request->getData('cover') && !empty($this->request->getData('cover')))
            {
                $path = './img/upload/articles';
                $file = $this->upload_file_transfer('cover', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG', $path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $article->cover = $file;
            }
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('The article').' '.__('has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The article').' '.__('could not be saved. Please, try again.'));
        }
        $users = $this->Articles->Users->find('list');
        $tags = $this->Articles->Tags->find('list');
        $categories = $this->Articles->Categories->find('treeList');
        $this->set(compact('article', 'users', 'tags', 'categories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        $img = $article->cover;
        if ($this->Articles->delete($article))
        {
            if (!empty($img))
            {
                $path = 'img/upload/articles/';
                if (file_exists($path))
                    unlink($path.$img);
                if (file_exists($path.'tb_'.$img))
                    unlink($path.'tb_'.$img);
            }
            $this->Flash->success(__('The article').' '.__('has been deleted.'));
        } else {
            $this->Flash->error(__('The article').' '.__('could not be deleted. Please, try again.'));
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
        $article = $this->Articles->get($id);
        $img = $article->cover;
        $article->cover = NULL;

        if ($this->Articles->save($article))
        {
            $path = 'img/upload/articles/';
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

        // Use the ArticlesTable to find tagged articles.
        $articles = $this->Articles->find('tagged', [
            'tags' => $tags
        ]);

        // Pass variables into the view template context.
        $this->set([
            'articles' => $articles,
            'tags' => $tags
        ]);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['add', 'tags'])) {
            return true;
        }
        elseif (in_array($action, ['edit', 'delete']))
        {
            $pass = $this->request->getParam('pass.0');

            if (!$pass) {
                return false;
            }
            elseif (is_numeric($pass)){ // Verifica se parametro é número
                $articleId = (int)$pass;
                if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
                    return true;
                }
            }
            else { // Caso contrário é tratado como slug
                $article = $this->Articles->findBySlug($slug)->first();
                return $article->user_id === $user['id']; // Check that the article belongs to the current user.
            }
        }
        return parent::isAuthorized($user);
    }
}
