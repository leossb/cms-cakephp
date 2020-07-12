<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pg $pg
 */


$this->assign('title', __('Pages'));
$this->Breadcrumbs->add('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Pages'), ['controller' => 'pgs', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Edit'), ['controller' => 'pgs', 'action' => 'edit', $pg->id], ['class' => 'breadcrumb-item active']);
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
            <p class="sub-header"><?= __('Edit') . ' ' . __('Page') ?></p>
            <?= $this->Form->create($pg) ?>
                <fieldset>
                    <?php
                    echo $this->Form->control('name', ['class'=>'form-control mb-2', 'label'=>__('Name')]);
                    echo $this->Form->control('slug', ['class'=>'form-control mb-2', 'label'=>__('URL amigável')]);
                    echo $this->Form->control('user_id', ['options' => $users, 'class'=>'form-control mb-2', 'label'=>__('User')]);
                    echo $this->Form->control('parent_id', ['options' => $parentPgs, 'empty'=>[0=>'Nenhum'], 'class'=>'form-control mb-2', 'label'=>__('Parent_id')]);
                    echo $this->Form->control('body', ['class'=>'form-control mb-2 summernote', 'label'=>__('Body')]);
                    echo $this->Form->control('published',['class'=>'checkbox-switchery', 'type'=>'checkbox', 'data-plugin'=>'switchery', 'data-color'=>'#5d6dc3']);
                    ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
            <?php // Lista
            if (!isset($list))
            {
                echo $this->Html->link('<i class="fas fa-plus"></i> '.__('Create List'),['controller'=>'PgsLists','action'=>'add',$pg->id],['class'=>'btn btn-success btn-large mt-4 px-5','escape'=>false]);
            }
            else
            {
                echo $this->Html->link('<i class="fas fa-plus"></i> '.__('Add Item'),['controller'=>'PgsLists','action'=>'add',$pg->id],['class'=>'btn btn-info btn-large mt-4 mb-3 px-5','escape'=>false]);
            ?>
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <tbody>
                    <?php foreach ($list as $item): ?>
                    <tr>
                        <td width="10%"><?= (!empty($item->image)) ? $this->Html->image('upload/pgs_lists/'.$item->image,['class'=>'img-fluid w-100']) : '' ?></td>
                        <td width="30%"><?= h($item->title) ?></td>
                        <td width="50%"><?= h($item->subtitle) ?></td>
                        <td width="10%">
                            <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['controller'=>'PgsLists','action'=>'edit',$item->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit'),'title'=>__('Edit')]) ?>
                            <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['controller'=>'PgsLists','action' => 'delete', $item->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'title'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $item->id)]) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </div>
    </div>
</div>
