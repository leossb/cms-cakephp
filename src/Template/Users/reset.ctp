<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="container h-100 d-flex align-items-center py-5">
    <div class="row w-100 m-auto">
        <div class="col-12 col-md-6 col-xl-4 m-auto">
            <?= $this->Form->create(null,['url'=>['controller'=>'Users','action'=>'reset',$user->passkey]]) ?>
                <h4 class="mb-3">Cadastrar nova senha</h4>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="password">Senha</label>
                        <?= $this->Form->control('password',['class'=>'form-control', 'label'=>false, 'type'=>'password']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="password2">Confirmar Senha</label>
                        <?= $this->Form->control('password2',['class'=>'form-control', 'label'=>false, 'type'=>'password']); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 pt-3">
                        <?= $this->Form->button(__('Enviar'),['class'=>'btn btn-primary btn-lg btn-block']) ?>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
