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
    <h5 class="text-uppercase text-center font-bold mt-4"><?= __('Recovery') ?></h5>
    <p><?= __('Insert your email account to receive an email with the instructions to recovery') ?></p>
</div>

<form action="mt-3">
    <div class="form-group mb-3">
        <?= $this->Form->control('email',['class'=>'form-control','required','placeholder'=>__('Enter your email'), 'type'=>'email']) ?>
    </div>

    <div class="clearfix"></div>

    <div class="form-group mt-4 mb-0 text-center">
        <button class="btn btn-gradient btn-block" type="submit"><?= __('Send') ?></button>
    </div>

</form>

<div class="row mt-4">
    <div class="col-sm-12 text-center">
        <p class="text-muted mb-0"><?= $this->Html->link('<strong>'.__('Back').'</strong>',['action'=>'login'],['class'=>'text-dark ml-1','escape'=>false]) ?></p>
    </div>
</div>
