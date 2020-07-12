<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PgsList $pgsList
 */
$this->assign('title', __('Pgs Lists'));
$this->Breadcrumbs->add('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Pgs Lists'), ['controller' => 'pgsLists', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Add'), ['controller' => 'pgsLists', 'action' => 'add'], ['class' => 'breadcrumb-item active']);
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
			<?= $this->Html->link(__('Back'), ['controller'=>'Pgs','action' => 'edit',$pg_id],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
			<h4 class="header-title"><b><?= __('Pgs Lists') ?> <?= $pg_name ?></b></h4>
            <p class="sub-header"><?= __('Add') . ' ' . __('Item') ?></p>

            <?= $this->Form->create($pgsList,['type'=>'file']) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('pg_id', ['type' => 'hidden', 'value'=>$pg_id]);
                    echo $this->Form->control('title', ['class'=>'form-control mb-2', 'label'=>__('Title')]);
                    echo $this->Form->control('subtitle', ['class'=>'form-control mb-2', 'label'=>__('Subtitle')]);
                    echo $this->Form->control('description', ['class'=>'form-control mb-2', 'label'=>__('Description')]);
                    echo $this->Form->control('image', ['class'=>'form-control mb-2', 'label'=>__('Image'), 'type'=>'file']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
