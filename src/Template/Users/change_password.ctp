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
    <h5 class="text-uppercase text-center font-bold mt-4"><?= __('Change password') ?></h5>
</div>

<?= $this->Form->create(null) ?>
    <div class="form-group mb-3">
         <?= $this->Form->control('password',['class'=>'form-control','required','placeholder'=>__('Enter your new password'), 'type'=>'password']) ?>
    </div>
    <div class="form-group mb-3">
         <?= $this->Form->control('password2',['class'=>'form-control','required','placeholder'=>__('Repeat your new password'), 'type'=>'password', 'label'=>__('Repeat').' '.__('password')]) ?>
    </div>

    <div class="clearfix"></div>

    <div class="form-group mt-4 mb-0 text-center">
        <button class="btn btn-gradient btn-block" type="submit"><?= __('Send') ?></button>
    </div>
<?= $this->Form->end() ?>

<div class="row mt-4">
    <div class="col-sm-12 text-center">
        <p class="text-muted mb-0"><?= $this->Html->link('<strong>'.__('Back').'</strong>','javascript:history.back(1);',['class'=>'text-dark ml-1','escape'=>false]) ?></p>
    </div>
</div>
