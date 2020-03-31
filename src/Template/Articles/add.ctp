<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Article $article
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
            <h4 class="header-title"><b><?= __('Articles') ?></b></h4>
            <p class="sub-header"><?= __('Add new') . ' ' . __('article') ?></p>
            <?= $this->Form->create($article) ?>
                <fieldset>
                    <?= $this->Form->control('category_id',['class'=>'form-control mb-2', 'label'=>__('Category'), 'empty'=>__('Select')]); ?>
                    <?=  $this->Form->control('title',['class'=>'form-control mb-2', 'label'=>__('Title')]); ?>
                    <?=  $this->Form->control('body',['class'=>'form-control mb-2', 'label'=>__('Body')]); ?>
                    <?=  $this->Form->control('published',['class'=>'checkbox-switchery','hiddenField' => false, 'type'=>'checkbox', 'data-plugin'=>'switchery', 'data-color'=>'#5d6dc3']); ?>
                    <?php //echo $this->Form->control('tags._ids', ['options' => $tags]); ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
