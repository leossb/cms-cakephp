<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pg $pg
 */
$this->assign('title', __('Pages'));
$this->Breadcrumbs->add('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Pages'), ['controller' => 'pgs', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Add'), ['controller' => 'pgs', 'action' => 'add'], ['class' => 'breadcrumb-item active']);
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
<?= $this->Html->css('../libs/summernote/summernote-bs4.css', ['block' => 'cssSummernote']) ?>

<!-- Script -->
<?= $this->Html->script('../libs/switchery/switchery.min.js', ['block' => 'scriptSwitchery']) ?>
<?= $this->Html->script('../libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js', ['block' => 'scriptTagsinput']) ?>
<?= $this->Html->script('../libs/select2/select2.min.js', ['block' => 'scriptSelect2']) ?>
<?= $this->Html->script('../libs/bootstrap-select/bootstrap-select.min.js', ['block' => 'scriptSelect']) ?>
<?= $this->Html->script('../libs/summernote/summernote-bs4.js', ['block' => 'scriptSummernote']) ?>
<?= $this->Html->script('../libs/summernote/summernote-cleaner.js', ['block' => 'scriptSummernote']) ?>

<!-- Form advanced init -->
<?= $this->Html->script('pages/form-advanced.init.js', ['block' => 'scriptFormadvancedInit']) ?>
<?= $this->Html->script('pages/summernote.init.js', ['block' => 'scriptSummernoteInit']) ?>

<div class="row">
	<div class="col-12">
		<div class="card-box table-responsive">
			<?= $this->Html->link(__('Back'), ['action' => 'index'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
			<h4 class="header-title"><b><?= __('Pages') ?></b></h4>
            <p class="sub-header"><?= __('Add') . ' ' . __('Page') ?></p>

            <?= $this->Form->create($pg) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('name', ['class'=>'form-control mb-2', 'label'=>__('Name')]);
                    echo $this->Form->control('user_id', ['options' => $users, 'class'=>'form-control mb-2', 'label'=>__('User')]);
                    echo $this->Form->control('parent_id', ['options' => $parentPgs, 'empty'=>[null=>'Nenhum'], 'class'=>'form-control mb-2', 'label'=>__('Parent')]);
                    echo $this->Form->control('body', ['class'=>'form-control mb-2', 'label'=>__('Body')]);
                    echo $this->Form->control('published',['class'=>'checkbox-switchery','hiddenField' => false, 'type'=>'checkbox', 'data-plugin'=>'switchery', 'data-color'=>'#5d6dc3']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
