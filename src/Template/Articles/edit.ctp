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
            <h4 class="header-title"><b><?= __('Articles') ?></b></h4>
            <p class="sub-header"><?= __('Edit') . ' ' . strtolower(__('Article')) ?></p>
            <?= $this->Form->create($article,['type'=>'file']) ?>
                <fieldset>
                    <?= $this->Form->control('category_id',['class'=>'form-control mb-2', 'label'=>__('Category'), 'empty'=>__('Select')]); ?>
                    <?=  $this->Form->control('title',['class'=>'form-control mb-2', 'label'=>__('Title')]); ?>
                    <?=  $this->Form->control('body',['class'=>'form-control mb-2 summernote', 'label'=>__('Body')]); ?><br/>
                    <?=  $this->Form->control('short_body',['class'=>'form-control mb-2', 'label'=>__('Short Body')]); ?>
                    <?php
                    if (empty($article->cover))
                        echo $this->Form->control('cover', ['class'=>'w-100 mb-2', 'label'=>__('Cover'), 'type'=>'file']);
                    else
                    {
                        echo $this->Form->label(__('Cover'));
                        echo '<br>' . $this->Html->image('upload/articles/tb_'.$article->cover,['width'=>'200']);
                        echo '<br>' . $this->Html->link('<i class="fas fa-close"></i> '.__('Delete') . ' ' .__('Image'),['action'=>'deleteImage', $article->id],['escape'=>false, 'class'=>'btn btn-danger mb-2']);
                    }
                    ?>
                    <?=  $this->Form->control('published',['class'=>'checkbox-switchery', 'type'=>'checkbox', 'data-plugin'=>'switchery', 'data-color'=>'#5d6dc3']); ?>
                    <?php //echo $this->Form->control('tags._ids', ['options' => $tags]); ?>
                </fieldset>
                <?= $this->Form->button(__('Submit'),['class'=>'clearfix mt-2 btn btn-gradient']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
