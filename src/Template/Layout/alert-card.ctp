<?php
/**
 * CMS Recriarti(tm) : Content Management System developed under CakePHP 3.8 (https://recriarti.com.br/desenvolvimento)
 * Copyright (c) Recriar Tecnologia da Informação Ltda. (https://recriarti.com.br)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Recriar Tecnologia da Informação Ltda. (https://recriarti.com.br)
 * @link          https://recriarti.com.br/desenvolvimento CMS Recriarti(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CMS';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->Html->charset() ?>
        <title><?= $cakeDescription ?> - <?= $this->fetch('title') ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Content Management System" name="description" />
        <meta content="Recriarti" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('icons.min.css') ?>
        <?= $this->Html->css('app.min.css') ?>
    </head>
    <body class="authentication-bg bg-gradient">
         <div class="account-pages mt-5 pt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">
                            <div class="card-body p-4">
                                <?= $this->Flash->render() ?>
                                <!-- ============================================================== -->
                                <?= $this->fetch('content') ?>
                                <!-- ============================================================== -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Html->script('vendor.min.js') ?>
        <?= $this->Html->script('app.min.js') ?>
    </body>
</html>
