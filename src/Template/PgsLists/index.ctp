<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PgsList[]|\Cake\Collection\CollectionInterface $pgsLists
 */
$this->assign('title', __('Pgs Lists'));
$this->Breadcrumbs->add('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Pgs Lists'), ['controller' => 'pgsLists', 'action' => 'index'], ['class' => 'breadcrumb-item active']);
?>

<!-- Css -->
<?= $this->Html->css('../libs/datatables/dataTables.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/datatables/buttons.bootstrap4.css', ['block' => 'cssDatatable']) ?>
<?= $this->Html->css('../libs/datatables/responsive.bootstrap4.css', ['block' => 'cssDatatable']) ?>

<!-- Required datatable js -->
<?= $this->Html->script('../libs/datatables/jquery.dataTables.min.js', ['block' => 'scriptDatatable']) ?>
<?= $this->Html->script('../libs/datatables/dataTables.bootstrap4.min.js', ['block' => 'scriptDatatable']) ?>

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
            <?= $this->Html->link(__('New Pgs List'), ['action' => 'add'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
            <h4 class="header-title"><b><?= __('Pgs Lists') ?></b></h4>
            <p class="sub-header"><?= __('Pgs Lists') ?> <?= __('List') ?></p>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                                            <th width="10%"><?= __('Id') ?></th>
                                            <th width="10%"><?= __('Title') ?></th>
                                            <th width="10%"><?= __('Subtitle') ?></th>
                                            <th width="10%"><?= __('Image') ?></th>
                                            <th width="10%"><?= __('Pg_id') ?></th>
                                            <th width="10%"><?= __('Created') ?></th>
                                            <th width="10%"><?= __('Modified') ?></th>
                                        <th width="10%"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pgsLists as $pgsList): ?>
                <tr>
                                                                                                                                                                                                                                        <td><?= $this->Number->format($pgsList->id) ?></td>
                                                                                                                                                                                                                                                                                            <td><?= h($pgsList->title) ?></td>
                                                                                                                                                                                                                                                                                            <td><?= h($pgsList->subtitle) ?></td>
                                                                                                                                                                                                                                                                                            <td><?= h($pgsList->image) ?></td>
                                                                                                                                                                                                                    <td><?= $pgsList->has('pg') ? $this->Html->link($pgsList->pg->name, ['controller' => 'Pgs', 'action' => 'view', $pgsList->pg->id]) : '' ?></td>
                                                                                                                                                                                                                                                                                                                    <td><?= h($pgsList->created) ?></td>
                                                                                                                                                                                                                                                                                            <td><?= h($pgsList->modified) ?></td>
                                                                                                                <td>
                        <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $pgsList->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit'),'title'=>__('Edit')]) ?>
                        <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['action' => 'delete', $pgsList->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'title'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $pgsList->id)]) ?>
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
