<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson[]|\Cake\Collection\CollectionInterface $lessons
 */
?>

<!-- Css -->
<?= $this->Html->css('../libs/datatables/dataTables.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/datatables/buttons.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/datatables/responsive.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/magnificPopup/magnific-popup.css', ['block' => 'cssMagnificPopup']) ?>

<!-- Required datatable js -->
<?= $this->Html->script('../libs/datatables/jquery.dataTables.min.js', ['block' => 'scriptDatatable']) ?>
<?= $this->Html->script('../libs/datatables/dataTables.bootstrap4.min.js', ['block' => 'scriptDatatable']) ?>

<?= $this->Html->script('../libs/datatables/dataTables.buttons.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/datatables/buttons.bootstrap4.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/jszip/jszip.min.js', ['block' => 'scriptJszip']) ?>
<?= $this->Html->script('../libs/pdfmake/pdfmake.min.js', ['block' => 'scriptPdfmake']) ?>
<?= $this->Html->script('../libs/pdfmake/vfs_fonts.js', ['block' => 'scriptVfsfonts']) ?>
<?= $this->Html->script('../libs/datatables/buttons.html5.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/datatables/buttons.print.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/magnificPopup/magnific-popup.min.js', ['block' => 'scriptMagnificPopup']) ?>

<!-- init -->
<?= $this->Html->script('pages/datatables.init.js', ['block' => 'scriptDatatableInit']) ?>
<?= $this->Html->script('pages/magnific-popup.init.js', ['block' => 'scriptMagnificPopupInit']) ?>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <?= $this->Html->link(__('New Lesson'), ['action' => 'add'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
            <h4 class="header-title"><b><?= __('Lessons') ?></b></h4>
            <p class="sub-header"><?= __('Lessons') ?> <?= __('List') ?></p>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th width="5%"><?= __('Id') ?></th>
                    <th width="10%"><?= __('Cover') ?></th>
                    <th width="45%"><?= __('Title') ?></th>
                    <th width="10%"><?= __('Video') ?></th>
                    <th width="10%"><?= __('Course') ?></th>
                    <th width="10%"><?= __('Modified') ?></th>
                    <th width="10%" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?= $this->Number->format($lesson->id) ?></td>
                    <td><?= (!empty($lesson->cover)) ? $this->Html->image('upload/lessons/'.$lesson->cover,['width'=>'100']) : '' ?></td>
                    <td><?= h($lesson->title) ?></td>
                    <td><?= (!empty($lesson->video)) ? $this->Html->link('<i class="fas fa-play"></i> '.__('Watch now'),$lesson->video,['class'=>'btn btn-primary video-btn video-popup','escape'=>false]) : '' ?></td>
                    <td><?= $lesson->has('topic') ? $lesson->topic->name : '' ?></td>
                    <td><?= h($lesson->modified) ?></td>
                    <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $lesson->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit'),'title'=>__('Edit')]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['action' => 'delete', $lesson->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'title'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $lesson->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    -->
</div>
