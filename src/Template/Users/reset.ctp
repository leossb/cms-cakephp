<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="text-center w-75 m-auto">
    <a href="index.html">
        <span><?= $this->Html->image('admin/logo-dark.png',["alt"=>"logo recriarti", "height"=>"18"]) ?></span>
    </a>
    <h5 class="text-uppercase text-center font-bold mt-4"><?= __('Register').' '.__('new password') ?></h5>
    <p><?= __('Choose your new password') ?></p>
</div>
<?= $this->Form->create(null,['url'=>['controller'=>'Users','action'=>'reset',$user->passkey]]) ?>
    <div class="form-group mb-3">
        <?= $this->Form->control('password',['class'=>'form-control', 'placeholder'=>__('Enter your new password'), 'type'=>'password']); ?>
    </div>
    <div class="form-group mb-3">
        <?= $this->Form->control(__('Repeat').' '.__('password'),['class'=>'form-control', 'placeholder'=>__('Repeat your new password'), 'type'=>'password']); ?>
    </div>
    <div class="clearfix"></div>
    <div class="form-group mt-4 mb-0 text-center">
        <button class="btn btn-gradient btn-block" type="submit"><?= __('Send') ?></button>
    </div>
<?= $this->Form->end() ?>
