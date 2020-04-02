<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Exam[]|\Cake\Collection\CollectionInterface $exams
 */
?>

<!-- Css -->
<?= $this->Html->css('../libs/datatables/dataTables.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/datatables/buttons.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/datatables/responsive.bootstrap4.css', ['block' => 'cssDatatable']) ?>

<!-- Required datatable js -->
<?= $this->Html->script('../libs/datatables/jquery.dataTables.min.js', ['block' => 'scriptDatatable']) ?>
<?= $this->Html->script('../libs/datatables/jquery.dataTables.min.js', ['block' => 'scriptDatatable']) ?>
<!-- Buttons examples -->
<?= $this->Html->script('../libs/datatables/dataTables.buttons.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/datatables/buttons.bootstrap4.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/jszip/jszip.min.js', ['block' => 'scriptJszip']) ?>
<?= $this->Html->script('../libs/pdfmake/pdfmake.min.js', ['block' => 'scriptPdfmake']) ?>
<?= $this->Html->script('../libs/pdfmake/vfs_fonts.js', ['block' => 'scriptVfsfonts']) ?>
<?= $this->Html->script('../libs/datatables/buttons.html5.min.js', ['block' => 'scriptDatatableAdv']) ?>
<?= $this->Html->script('../libs/datatables/buttons.print.min.js', ['block' => 'scriptDatatableAdv']) ?>
<!-- Datatables init -->
<?= $this->Html->script('pages/datatables.init.js', ['block' => 'scriptDatatableInit']) ?>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <?= $this->Html->link(__('New') . ' ' . __('Exam'), ['action' => 'add'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
            <h4 class="header-title"><b><?= __('Exams') ?></b></h4>
            <p class="sub-header"><?= __('Exams') ?> <?= __('List') ?></p>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Topic') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($exams as $exam): ?>
                <tr>
                    <td><?= $this->Number->format($exam->id) ?></td>
                    <td><?= h($exam->name) ?></td>
                    <td><?= $exam->has('topic') ? $this->Html->link($exam->topic->name, ['controller' => 'Topics', 'action' => 'view', $exam->topic->id]) : '' ?></td>
                    <td><?= h($exam->created) ?></td>
                    <td><?= h($exam->modified) ?></td>
                    <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $exam->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit'),'title'=>__('Edit')]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['action' => 'delete', $exam->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'title'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $exam->id)]) ?>
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
