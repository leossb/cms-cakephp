<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pg[]|\Cake\Collection\CollectionInterface $pgs
 */
$this->assign('title', __('Pages'));
$this->Breadcrumbs->add('Dashboard', ['controller' => 'dashboard', 'action' => 'index'], ['class' => 'breadcrumb-item']);
$this->Breadcrumbs->add(__('Pages'), ['controller' => 'pgs', 'action' => 'index'], ['class' => 'breadcrumb-item active']);
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
            <?= $this->Html->link(__('New Page'), ['action' => 'add'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
            <h4 class="header-title"><b><?= __('Pages') ?></b></h4>
            <p class="sub-header"><?= __('Pages') ?> <?= __('List') ?></p>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th width="5%"><?= __('Id') ?></th>
                    <th width="20%"><?= __('Name') ?></th>
                    <th width="10%"><?= __('User') ?></th>
                    <th width="20%"><?= __('Parent') ?></th>
                    <th width="20%"><?= __('Slug') ?></th>
                    <th width="5%"><?= __('Published') ?></th>
                    <th width="10%"><?= __('Modified') ?></th>
                    <th width="10%"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($pgs as $pg): ?>
                <tr>
                    <td><?= $this->Number->format($pg->id) ?></td>
                    <td><?= h($pg->name) ?></td>
                    <td><?= $pg->has('user') ? $this->Html->link($pg->user->name, ['controller' => 'Users', 'action' => 'view', $pg->user->id]) : '' ?></td>
                    <td><?= $pg->has('parent_pg') ? $this->Html->link($pg->parent_pg->name, ['controller' => 'Pgs', 'action' => 'view', $pg->parent_pg->id]) : '' ?></td>
                    <td><?= h($pg->slug) ?></td>
                    <td><?= ($pg->published == 1) ? 'SIM' : 'NÃO'; ?></td>
                    <td><?= h($pg->modified) ?></td>
                    <td>
                    <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $pg->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit'),'title'=>__('Edit')]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['action' => 'delete', $pg->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'title'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $pg->id)]) ?>
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
