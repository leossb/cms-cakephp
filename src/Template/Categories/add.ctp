<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
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
			<h4 class="header-title">
				<b>Categories</b>
            </h4>
            <p class="sub-header"><?= __('Add') . ' ' . __('Category') ?></p>

            <?= $this->Form->create($category) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('parent_id', ['options' => $parentCategories, 'class'=>'form-control mb-2', 'label'=>__('Parent_id'), 'empty'=>[null=>'Selecione']]);
                    echo $this->Form->control('name', ['class'=>'form-control mb-2', 'label'=>__('Name')]);
                    echo $this->Form->control('description', ['class'=>'form-control mb-2', 'label'=>__('Description')]);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
