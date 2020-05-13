<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardController extends AppController
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
        /*
        $user = $this->Auth->user();
        if ($user['role'] == 'guest')
            return $this->redirect(['controller' => 'members', 'action'=>'index']);
        */
        $this->loadModel('Comments');
        $comments = $this->Comments->find('all',[
            'contain'=>['Users','Articles'],
            'order'=>['Comments.id DESC'],
            'conditions'=>['active'=>0]
        ]);
        $this->set(compact('comments'));
    }

    /**
     * isAuthorized method
     *
     * @return \Cake\Http\Response|null
     *
     * Essa função sobrescreve a regra criada no app controller
     * fazendo com que usuário "guest" possam acessar esta área
     *
     */
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['index']))
            return true;

        return parent::isAuthorized($user);
    }
}
