<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Routing\Router;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout', 'add', 'forgot', 'reset']);
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
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Articles'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();

        if ($this->request->is('post'))
        {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if (!empty($this->request->getData('avatar')))
            {
                $path = './img/upload/users/';
                $file = $this->upload_file_transfer('avatar', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG',$path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $user->avatar = $file;
            }

            $uniquecode = substr(md5(microtime()),0,10); //generate random string
            $randomKey = substr(md5(microtime()),0,10);
            $user->otp = $uniquecode;

            if ($this->Users->save($user))
            {
                // Caso usuário escolha avisar o novo usuário por email
                if ($this->request->getData('send') == 1)
                {
                    $site_description = 'CMS Recriarti';
                    $site_email = 'suporte@recriarti.com.br';
                    $aLink = Router::url(array("controller"=>"Users","action"=>"activate", $uniquecode, $randomKey),true);
                    $subject = '['.$site_description.'] VERIFIQUE SUA CONTA';
                    $sender_email = $site_email;
                    $sender_name = $site_description;
                    $to_email = $user->email;
                    $to_name = $user->name;

                    $message = '<h1>Olá '.$user->name.', obrigado por se cadastrar na nossa plataforma.</h1>
                    <p>Por favor, para confirmar seu cadastro e liberar seu acesso a plataforma, clique no link abaixo ou copie e cole no seu navegador:</p>
                    <p>Link de verificação: '.$aLink.'</p>
                    <p>Qualquer dúvida ou dificuldade, por favor, entre em contato através do email '.$site_email.'.</p>
                    <p>Um grande abraço,<br>Equipe '.$site_description.'</p>
                    <hr>
                    <p>Caso você não tenha se cadastrado na nossa plataforma ou desconheça o teor deste email, por favor desconsiere-o.</p>
                    <p>Essa é uma mensagem automática. Por favor, não responda a este email.</p>';

                    $mail = new Email();
                    $mail->setEmailFormat('html');
                    $mail->setProfile(['from' => 'leossb@gmail.com', 'transport' => 'gmail']);
                    $mail->setSender($sender_email, $sender_name);
                    $mail->setReplyTo($sender_email);
                    $mail->setSubject($subject);
                    $mail->setTo($to_email, $to_name);
                    $mail->send($message);
                }

                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        $actualImage = $user->avatar;
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($actualImage != $this->request->getData('avatar') && !empty($this->request->getData('avatar')))
            {
                $path = './img/upload/users/';
                $file = $this->upload_file_transfer('avatar', 'sim', 'jpg,jpeg,JPEG,JPG,png,PNG', $path, 'nao', '200000', 'nao');
                $this->resizeImage($file,$path,$path,1200,''); // Arquivo, origem, destino, largura, pre
                $this->resizeImage($file,$path,$path,300,'tb_'); // Arquivo, origem, destino, largura, pre
                $user->avatar = $file;
            }
            if ($this->Users->save($user))
            {
                $this->Flash->success(__('The user has been updated.'));
                return $this->redirect(['action' => 'edit', $id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteImage($id)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $img = $user->avatar;
        $user->avatar = NULL;

        if ($this->Users->save($user))
        {
            unlink('img/upload/users/'.$img);
            $this->Flash->success(__('The image user has been deleted.'));
        }
        else
            $this->Flash->error(__('The image user could not be deleted. Please, try again.'));

        return $this->redirect(['action' => 'edit', $id]);
    }

    public function login()
    {
        $this->viewBuilder()->setLayout('alert-card');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
        $this->viewBuilder()->setLayout('alert-card');
        $this->Flash->success('You are now logged out.');
        //return $this->redirect($this->Auth->logout());
    }

    /**
     * Activate method
     *
     * @return \Cake\Http\Response|null Redirects to login on successful update verified account.
     */
    public function activate($getUniCode='', $randomKey='')
    {
        if(trim($getUniCode)!="" && $randomKey!="") {
            $getUniCode = filter_var($getUniCode, FILTER_SANITIZE_STRING);
            $getUser = $this->Users->find('all',['conditions'=> ['otp'=> $getUniCode,'verified'=> 0]])->first();
            if($getUser)
            {
                $getUserId = $getUser->id;
                $updateActivate  = $this->Users->updateAll(['verified'=> 1, 'otp'=> ''], ['id'=> $getUserId]);
                $this->Flash->success(__('Your account was activated. Please sign in.'));
                return $this->redirect(['action' => 'login']);
            }
        }
    }

    /**
     * Forgot method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function forgot()
    {
        $this->viewBuilder()->setLayout('alert-card');
        $user = $this->Users->newEntity();
        if ($this->request->is('post'))
        {
            if ($this->request->getData('email'))
            {
                $email = $this->request->getData('email');

                // Verifica se existe esse email na base de dados
                $users = $this->Users->find('all',['conditions'=>['email'=>$email]]);
                $user = $users->first();

                if (is_null($user))
                    $this->Flash->error(__('This email address does not exist. Please, try again or create a new account.'));
                else
                {
                    $passkey = uniqid();
                    $url = Router::Url(['controller' => 'users', 'action' => 'reset'], true) . '/' . $passkey;
                    $timeout = time() + DAY;
                    if ($this->Users->updateAll(['passkey' => $passkey, 'timeout' => $timeout], ['id' => $user->id])){
                        $this->sendResetEmail($url, $user);
                        $this->redirect(['action' => 'login']);
                    }
                    else
                        $this->Flash->error(__('Error to reset passkey/timeout'));
                }
            }
        }
        $this->set(compact('user'));
    }

    private function sendResetEmail($url, $user)
    {
        $site_description = 'CMS Recriarti';
        $site_email = 'suporte@recriarti.com.br';
        //$aLink = Router::url(array("controller"=>"Users","action"=>"activate", $uniquecode, $randomKey),true);
        $subject = '['.$site_description.'] Recuperação de Senha';
        $sender_email = $site_email;
        $sender_name = $site_description;
        $to_email = $user->email;
        $to_name = $user->name;

        $name = $user->name;
        $email = $user->email;

        $message = '<p>Oi ' . $name . ',</p>
        <p>Foi solicitado a recuperação da sua senha de acesso a plataforma '.$site_description.'. Caso não tenha sido você, por favor, ignore este email.</p>
        <p>Caso queira redefinir sua senha, <a href="'.$url.'" target="_blank">Clique aqui</a>.</p>
        <p>Atenciosamente, equipe '.$site_description.'</p>';

        $message_alt = 'Oi ' . $name . ', foi solicitado a recuperação da sua senha de acesso a '.$site_description.'. Caso não tenha sido você, por favor, ignore este email. Caso queira redefinir sua senha,  clique no link: '.$url.'. Atenciosamente, equipe '.$site_description;

        $mail = new Email();
        $mail->setEmailFormat('html');
        $mail->setProfile(['from' => 'leossb@gmail.com', 'transport' => 'gmail']);
        $mail->setSender($sender_email, $sender_name);
        $mail->setReplyTo($sender_email);
        $mail->setSubject($subject);
        $mail->setTo($email, $name);
        if($mail->send($message))
            $this->Flash->success(__('We have send an email with the password recovery. Please, verify your spam box.'));
        else
            $this->Flash->error(__('Email does not sent.') . $mail->smtpError,['key' => 'contato']);
    }

    public function reset($passkey = null)
    {
        $this->viewBuilder()->setLayout('alert-card');

        if ($passkey) {
            $query = $this->Users->find('all', ['conditions' => ['passkey' => $passkey, 'timeout >' => time()]]);
            $user = $query->first();
            if ($user) {
                if (!empty($this->request->getData()))
                {
                    $user = $this->Users->patchEntity($user, $this->request->getData());
                    $user->passkey = null;
                    $user->timeout = null;
                    //$user->password = $this->_setPassword($user->password);
                    if ($this->Users->save($user)) {
                        $this->Flash->set(__('Your password was updated successfully. Please sign in.'));
                        return $this->redirect(array('action' => 'login'));
                    } else {
                        $this->Flash->error(__('Password could not be saved. Please try again.'));
                    }
                }
            } else {
                $this->Flash->error(__('Keypass invalid or expired. Please, verify your email or try again.'));
                $this->redirect(['action' => 'forgot']);
            }
            unset($user->password);
            $this->set(compact('user'));
        } else {
            $this->redirect('/');
        }
    }

    /**
     * Change method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function changePassword($id = null)
    {
        $this->viewBuilder()->setLayout('alert-card');

        $user_logged = $this->Auth->user();

        if ($user_logged['role'] == 'admin' && !is_null($id))
            $user = $this->Users->get($id);
        else
            $user = $this->Users->get($user_logged['id']);

        if ($this->request->is('post'))
        {
            if ($this->request->getData('password') != $this->request->getData('password2'))
                $this->Flash->error(__('The passwords does not match. Please, try again.'));
            else
            {
                $user = $this->Users->patchEntity($user, $this->request->getData());
                if ($this->Users->save($user))
                    $this->Flash->success(__('Password updated successfully'));
                else
                    $this->Flash->error(__('Password does not be updated'));

                return ($user_logged['role'] == 'admin') ? $this->redirect(['action'=>'index']) : $this->redirect(['controller'=>'Pages','action'=>'display','index']);
            }
        }

        $this->set(compact('user'));
    }

    public function cropper($image)
    {
        $path = 'upload/users/';
        $this->set(compact('image','path'));
    }
}
