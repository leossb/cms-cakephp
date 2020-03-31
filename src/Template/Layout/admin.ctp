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
        <meta name="description" content="Content Management System" />
        <meta name="author" content="Recriarti" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <?= $this->Html->meta('icon') ?>

        <?= $this->fetch('cssDatatable') ?> <!-- Datatable block -->
        <?= $this->fetch('cssTagsinput') ?> <!-- Tags input block -->
        <?= $this->fetch('cssSwitchery') ?> <!-- Switchery block -->
        <?= $this->fetch('cssSelect2') ?>   <!-- Select2 block -->
        <?= $this->fetch('cssSelect') ?>    <!-- Select block -->

        <!-- Required css -->
        <?= $this->Html->css('bootstrap.min.css') ?>
        <?= $this->Html->css('icons.min.css') ?>
        <?= $this->Html->css('app.min.css') ?>
        <?= $this->Html->css('custom.css') ?>
    </head>
    <body>
        <div id="wrapper">
            <!-- Top -->
            <div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="dropdown d-none d-lg-block">
                        <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <?= $this->Html->image('admin/flags/us.jpg',["alt"=>"user-image", "class"=>"mr-1", "height"=>"12"]) ?> <span class="align-middle">English <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <?= $this->Html->image('admin/flags/brazil.jpg',["alt"=>"user-image", "class"=>"mr-1", "height"=>"12"]) ?> <span class="align-middle">Português</span>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fe-bell noti-icon"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">0</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="" class="text-dark">
                                            <small><?= __('Clear All') ?></small>
                                        </a>
                                    </span><?= __('Notification') ?>
                                </h5>
                            </div>
                            <div class="slimscroll noti-scroll">

                            </div>
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                <?= __('View all') ?>
                                <i class="fi-arrow-right"></i>
                            </a>

                        </div>
                    </li>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <?= $this->Html->image('admin/users/avatar-1.jpg',["alt"=>"user-image", "class"=>"rounded-circle"]) ?>
                            <span class="ml-1"><?= $user['name'] ?> <i class="mdi mdi-chevron-down"></i> </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0"><?= __('Welcome') ?></h6>
                            </div>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-user"></i><span><?= __('Account') ?></span>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fe-settings"></i><span><?= __('Change password') ?></span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <?= $this->Html->link('<i class="fe-log-out"></i><span>'.__('Logout').'</span>',['controller'=>'users','action'=>'logout'],['class'=>'dropdown-item notify-item', 'escape'=>false]) ?>
                        </div>
                    </li>
                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>
                </ul>

                <div class="logo-box">
                    <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <?= $this->Html->image('admin/logo-light.png',["alt"=>"logo recriarti", "height"=>"16"]) ?>
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <?= $this->Html->image('admin/logo-sm.png',["alt"=>"logo recriarti", "height"=>"28"]) ?>
                        </span>
                    </a>
                </div>
                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>
                    <li class="d-none d-sm-block">
                        <form class="app-search">
                            <div class="app-search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>

            <!-- ========== Left Sidebar ========== -->
            <div class="left-side-menu">
                <div class="slimscroll-menu">
                    <div id="sidebar-menu">
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title"><?= __('Navigation') ?></li>
                            <li><?= $this->Html->link('<i class="fe-airplay"></i><span>'.__('Dashboard').'</span>',['controller'=>'dashboard','action'=>'index'],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link('<i class="fe-layout"></i><span>'.__('Categories').'</span>',['controller'=>'categories','action'=>'index'],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link('<i class="fe-bookmark"></i><span>'.__('Articles').'</span>',['controller'=>'articles','action'=>'index'],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link('<i class="fe-book-open"></i><span>'.__('Pages').'</span>',['controller'=>'pgs','action'=>'index'],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link('<i class="fe-file-text"></i><span>'.__('Tags').'</span>',['controller'=>'tags','action'=>'index'],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link('<i class="fe-box"></i><span>'.__('Comments').'</span>',['controller'=>'comments','action'=>'index'],['escape'=>false]) ?></li>
                            <li><?= $this->Html->link('<i class="fe-users"></i><span>'.__('Users').'</span>',['controller'=>'users','action'=>'index'],['escape'=>false]) ?></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <!-- Content -->
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Abstack</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Dashboard</h4>
                                </div>
                            </div>
                        </div>

                        <!-- ============================================================== -->
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                        <!-- ============================================================== -->

                    </div>
                </div>
                <!-- Footer -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?= date('Y') ?> &copy; <?= __('Developed by') ?> <a href="https://recriarti.com.br" target="_blank">Recriarti</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h5 class="m-0 text-white">Settings</h5>
            </div>
            <div class="slimscroll-menu">
                <hr class="mt-0">
                <h5 class="pl-3">Basic Settings</h5>
                <hr class="mb-0" />

                <div class="p-3">
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                        <label class="custom-control-label" for="customCheck1">Notifications</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck2" checked>
                        <label class="custom-control-label" for="customCheck2">API Access</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                        <label class="custom-control-label" for="customCheck3">Auto Updates</label>
                    </div>
                    <div class="custom-control custom-checkbox mb-2">
                        <input type="checkbox" class="custom-control-input" id="customCheck4" checked>
                        <label class="custom-control-label" for="customCheck4">Online Status</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck5">
                        <label class="custom-control-label" for="customCheck5">Auto Payout</label>
                    </div>
                </div>

                <hr class="mt-0" />
                <h5 class="pl-3 pr-3">Messages <span class="float-right badge badge-pill badge-danger">24</span></h5>
                <hr class="mb-0" />
                <div class="p-3">
                    <div class="inbox-widget">
                        <div class="inbox-item">
                            <div class="inbox-item-img"><?= $this->Html->image('admin/users/avatar-1.jpg',["alt"=>"user-image", "class"=>"rounded-circle"]) ?></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);">Chadengle</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">13:40 PM</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><?= $this->Html->image('admin/users/avatar-2.jpg',["alt"=>"user-image", "class"=>"rounded-circle"]) ?></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);">Tomaslau</a></p>
                            <p class="inbox-item-text">I've finished it! See you so...</p>
                            <p class="inbox-item-date">13:34 PM</p>
                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><?= $this->Html->image('admin/users/avatar-3.jpg',["alt"=>"user-image", "class"=>"rounded-circle"]) ?></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);">Stillnotdavid</a></p>
                            <p class="inbox-item-text">This theme is awesome!</p>
                            <p class="inbox-item-date">13:17 PM</p>
                        </div>

                        <div class="inbox-item">
                            <div class="inbox-item-img"><?= $this->Html->image('admin/users/avatar-4.jpg',["alt"=>"user-image", "class"=>"rounded-circle"]) ?></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);">Kurafire</a></p>
                            <p class="inbox-item-text">Nice to meet you</p>
                            <p class="inbox-item-date">12:20 PM</p>

                        </div>
                        <div class="inbox-item">
                            <div class="inbox-item-img"><?= $this->Html->image('admin/users/avatar-5.jpg',["alt"=>"user-image", "class"=>"rounded-circle"]) ?></div>
                            <p class="inbox-item-author"><a href="javascript: void(0);">Shahedk</a></p>
                            <p class="inbox-item-text">Hey! there I'm available...</p>
                            <p class="inbox-item-date">10:15 AM</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="rightbar-overlay"></div>

        <?= $this->Html->script('vendor.min.js') ?>


        <!-- Datatable block -->
        <?= $this->fetch('scriptDatatable') ?>
        <!-- Datatable Advanced block -->
        <?= $this->fetch('scriptDatatableAdv') ?>
        <!-- Js Zup block -->
        <?= $this->fetch('scriptJszip') ?>
        <!-- PDF Make block -->
        <?= $this->fetch('scriptPdfmake') ?>
        <!-- Vfs Fonts block -->
        <?= $this->fetch('scriptVfsfonts') ?>
        <!-- Switchery block -->
        <?= $this->fetch('scriptSwitchery') ?>
        <!-- Tags Input block -->
        <?= $this->fetch('scriptTagsinput') ?>
        <!-- Select2 Block -->
        <?= $this->fetch('scriptSelect2') ?>
        <!-- Select Block -->
        <?= $this->fetch('scriptSelect') ?>


        <!-- Datatable Init block -->
        <?= $this->fetch('scriptDatatableInit') ?>
        <!-- Form Advanced Init block -->
        <?= $this->fetch('scriptFormadvancedInit') ?>

        <?= $this->Html->script('app.min.js') ?>
        <?= $this->Html->script('custom.js') ?>
    </body>
</html>