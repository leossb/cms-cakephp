<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<style>
	.checkbox label::before {
		display: none !important;
	}
</style>
<!-- Css -->
<?= $this->Html->css('../libs/bootstrap-tagsinput/bootstrap-tagsinput.css', ['block' => 'cssTagsinput']) ?>
<?= $this->Html->css('../libs/switchery/switchery.min.css', ['block' => 'cssSwitchery']) ?>
<?= $this->Html->css('../libs/select2/select2.min.css', ['block' => 'cssSelect2']) ?>
<?= $this->Html->css('../libs/bootstrap-select/bootstrap-select.min.css', ['block' => 'cssSelect']) ?>

<!-- Script -->
<?= $this->Html->script('../libs/switchery/switchery.min.js', ['block' => 'scriptSwitchery']) ?>
<?= $this->Html->script('../libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js', ['block' => 'scriptTagsinput']) ?>
<?= $this->Html->script('../libs/select2/select2.min.js', ['block' => 'scriptSelect2']) ?>
<?= $this->Html->script('../libs/bootstrap-select/bootstrap-select.min.js', ['block' => 'scriptSelect']) ?>

<!-- Form advanced init -->
<?= $this->Html->script('pages/form-advanced.init.js', ['block' => 'scriptFormadvancedInit']) ?>

<div class="row">
	<div class="col-12">
		<div class="card-box table-responsive">
			<?= $this->Html->link(__('Back'), ['action' => 'index'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
			<h4 class="header-title"><b><?= __('Users') ?></b></h4>
            <p class="sub-header"><?= __('Edit') . ' ' . __('User') ?></p>

            <?= $this->Form->create($user,['type'=>'file']) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('email', ['class'=>'form-control mb-2', 'label'=>__('Email')]);
                    echo $this->Form->control('name', ['class'=>'form-control mb-2', 'label'=>__('Name')]);
                    echo $this->Form->control('role', ['class'=>'form-control mb-2', 'label'=>__('Role'), 'options'=>['admin'=>__('Admin'),'author'=>__('Author')]]);
                    if (empty($user->avatar))
                        echo $this->Form->control('avatar', ['class'=>'form-control mb-2', 'label'=>__('Photo'), 'type'=>'file']);
                    else
                    {
                        echo $this->Form->label(__('Image'));
                        echo '<br>' . $this->Html->image('upload/users/'.$user->avatar,['width'=>'200']);
                        echo '<br>' . $this->Html->link('<i class="fas fa-close"></i> '.__('Delete') . ' ' .__('Image'),['action'=>'deleteImage', $user->id, $user->avatar],['escape'=>false, 'class'=>'btn btn-danger']);
                    }
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
