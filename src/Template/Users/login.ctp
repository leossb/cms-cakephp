<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="text-center w-75 m-auto">
    <a href="index.html">
        <span><?= $this->Html->image('admin/logo-dark.png',["alt"=>"logo recriarti", "height"=>"18"]) ?></span>
    </a>
    <h5 class="text-uppercase text-center font-bold mt-4"><?= __('Sign In') ?></h5>
</div>

<?= $this->Form->create(null) ?>
    <div class="form-group mb-3">
        <?= $this->Form->control('email',['class'=>'form-control','required','placeholder'=>__('Enter your email'), 'type'=>'email']) ?>
    </div>
    <div class="form-group mb-3">
         <?= $this->Form->control('password',['class'=>'form-control','required','placeholder'=>__('Enter your password'), 'type'=>'password']) ?>
    </div>
    <div class="form-group mb-3">
        <div class="custom-control custom-checkbox checkbox-success float-left">
            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
            <label class="custom-control-label" for="checkbox-signin"><?= __('Remember me') ?></label>
        </div>
        <?= $this->Html->link('<small>'.__('Forgot your password?').'</small>',['action'=>'forgot'],['class'=>'text-muted float-right','escape'=>false]) ?>
    </div>

    <div class="clearfix"></div>

    <div class="form-group mt-4 mb-0 text-center">
        <button class="btn btn-gradient btn-block" type="submit"><?= __('Log In') ?></button>
    </div>

<?= $this->Form->end() ?>

<div class="row mt-4">
    <div class="col-sm-12 text-center">
        <p class="text-muted mb-0"><?= __('Don\'t have an account?') ?> <?= $this->Html->link('<strong>'.__('Sign up').'</strong>',['action'=>'add'],['class'=>'text-dark ml-1','escape'=>false]) ?></p>
    </div>
</div>
