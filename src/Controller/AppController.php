<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public function beforeFilter(Event $event)
    {
        // Allow the display action so our PagesController
        // continues to work. Also enable the read only actions.
        $this->Auth->allow(['view', 'display']);
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => $this->referer()
        ]);
        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');


        $webroot = $this->request->getAttribute('webroot');
        $user_logged = $this->Auth->user();

        $this->set(compact('user_logged','webroot'));
    }

    public function isAuthorized($user)
    {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        return false;
    }

    public function upload_multiple_files($upload, $folder = null)
    {
        $folder = (!empty($folder)) ? $folder : 'sliders';
        $array_files = array();
        $total = count($_FILES[$upload]['name']);
        for( $i=0 ; $i < $total ; $i++ )
        {
            $tmpFilePath = $_FILES[$upload]['tmp_name'][$i];
            if ($tmpFilePath != "")
            {
                $newFilePath = "./img/".$folder."/".$_FILES[$upload]['name'][$i];
                if(move_uploaded_file($tmpFilePath, $newFilePath))
                {
                    $array_files[] = $_FILES[$upload]['name'][$i];
                }
            }
        }
        return $array_files;
    }

    public function upload_file_transfer($id_arquivo, $limitar_ext, $extensoes, $caminho_absoluto, $limitar_tamanho, $tamanho_bytes, $sobrescrever)
    {
        $parte = explode(',',$extensoes);
        $exts = count($parte);
        $extensoes_validas = array();
        for ($i=0; $i<$exts; $i++){
            $extensao = '.'.$parte[$i];
            $extensoes_validas[$i] = $extensao;
        }

        set_time_limit (0);

        $nome_arquivo = '';
        $erro = FALSE;
        $msg = '';

        if (isset ($_FILES[$id_arquivo]['name'])) $nome_arquivo = $_FILES[$id_arquivo]['name'];
        if (isset ($_FILES[$id_arquivo]['size'])) $tamanho_arquivo = $_FILES[$id_arquivo]['size'];
        if (isset ($_FILES[$id_arquivo]['tmp_name'])) $arquivo_temporario = $_FILES[$id_arquivo]['tmp_name'];
        if (!empty ($nome_arquivo))
        {
            $ext = strrchr($nome_arquivo,'.');
            $nome_arquivo = $id_arquivo.date('YmdHis').$ext;

            if ($sobrescrever == "nao" && file_exists("$caminho_absoluto/$nome_arquivo")){
                $erro = TRUE;
                $msg = 'Arquivo '.$nome_arquivo.' já existe!';
            }
            if (($limitar_tamanho == "sim") && ($tamanho_arquivo > $tamanho_bytes)){
                $erro = TRUE;
                $msg = 'Arquivo '.$nome_arquivo.' deve ter no máximo'.$tamanho_bytes.' bytes';
            }
            if ($limitar_ext == "sim" && !in_array($ext,$extensoes_validas)){
                $erro = TRUE;
                $msg = 'Extensão do arquivo '.$nome_arquivo.' inválida para upload.';
            }
            if(!$erro && move_uploaded_file($arquivo_temporario,"$caminho_absoluto/$nome_arquivo"))
            {
                chmod("$caminho_absoluto/$nome_arquivo", 0777);
                return $nome_arquivo;
            }
            else {
                $this->Flash->error($msg);
                $nome_arquivo = '';
                return $nome_arquivo;
            }
        }
        else return $nome_arquivo;
    }

    public function cropimg()
    {
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $original_path = $this->request->getData('original_path');
            $original_filename = $this->request->getData('original_filename');
            $new_path = $this->request->getData('new_path');
            $new_filename = $this->request->getData('new_filename');
            $topleft_x = $this->request->getData('x');
            $topleft_y = $this->request->getData('y');
            $crop_width = $this->request->getData('w');
            $crop_height = $this->request->getData('h');
            $thumb_width = $this->request->getData('thumb_width');
            $thumb_height = $this->request->getData('thumb_height');

            $original_photo = ('../webroot/img/'.$original_path.'/'.$original_filename);
            $new_photo = ('../webroot/img/'.$new_path.'/'.$new_filename);

            $size = getimagesize($original_photo);
            $gdimg = $this->GDImage($size[2], $original_photo);   // Cria a palheta da imagem original
            $bigthumb = imagecreatetruecolor($crop_width, $crop_height);            // Cria imagem em branco
            imagecopy($bigthumb, $gdimg, 0, 0, $topleft_x, $topleft_y, $crop_width, $crop_height);  // Cropa a seleção especifica do gd e coloca na imagem em branco $thumb

            if($crop_width > $thumb_width || $crop_height > $thumb_height)          // Se a area de cropping for maior do que o tamanho final deveria se para o thumb, redimensione
            {
                $thumb = imagecreatetruecolor($thumb_width, $thumb_height);         // Cria imagem em branco

                # Redimensiona a foto para o tamanho final do thumb
                imagecopyresampled(
                    $thumb, $bigthumb,
                    0, 0,
                    0, 0,
                    $thumb_width, $thumb_height,
                    $crop_width, $crop_height);
            }
            else
                $thumb = $bigthumb;

            $savefilename = ($new_path == null) ? $new_filename : $new_photo; // Salva-o como jpg
            imagejpeg($thumb, $savefilename, 100);

            return $this->redirect(['action' => 'index']);
        }
    }

    public function GDImage($imagetype, $Original)
    {
        $gdimage = null;
        switch($imagetype)
        {
            case 1: $gdimage = imagecreatefromgif ($Original); break;
            case 2: $gdimage = imagecreatefromjpeg($Original); break;
            case 3: $gdimage = imagecreatefrompng ($Original); break;
        }
        if(!$gdimage) die('Failed GDImage');
        return $gdimage;
    }

    public function resizeImage($arquivo,$origem,$destino,$largura,$pre)
    {
        $filename = $origem . '/' . $arquivo;
        $new_filename = $destino . '/'  . $pre . $arquivo;

        $ext = explode(".",strtolower($filename));
        $n = count($ext)-1;
        $ext = $ext[$n];

        list($width_orig, $height_orig, $type, $attr) = getimagesize($filename);
        if ($width_orig > $largura)
        {
            $width = $largura;
            $height = ($height_orig * $largura)/$width_orig;
            $image_p = imagecreatetruecolor($width, $height);

            if ($ext == 'jpg' || $ext == 'jpeg')    $image = imagecreatefromjpeg($filename);
            elseif($ext == 'png')                   $image = imagecreatefrompng($filename);
            elseif($ext == 'gif')                   return false;

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

            if ($ext == 'jpg' || $ext == 'jpeg')    imagejpeg($image_p, $new_filename, 100);
            elseif($ext == 'png')                   imagepng($image_p, $new_filename);
            elseif($ext == 'gif')                   return false;
        }
    }
}
