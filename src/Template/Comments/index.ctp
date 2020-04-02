<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment[]|\Cake\Collection\CollectionInterface $comments
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
            <?= $this->Html->link(__('New'). ' ' . __('Comment'), ['action' => 'add'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
            <h4 class="header-title"><b><?= __('Comments') ?></b></h4>
            <p class="sub-header"><?= __('Comments') ?> <?= __('List') ?></p>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th scope="col"><?= __('id') ?></th>
                    <th scope="col"><?= __('User') ?></th>
                    <th scope="col"><?= __('Article') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td><?= $this->Number->format($comment->id) ?></td>
                    <td><?= $comment->has('user') ? $this->Html->link($comment->user->name, ['controller' => 'Users', 'action' => 'view', $comment->user->id]) : '' ?></td>
                    <td><?= $comment->has('article') ? $this->Html->link($comment->article->title, ['controller' => 'Articles', 'action' => 'view', $comment->article->id]) : '' ?></td>
                    <td><?= h($comment->created) ?></td>
                    <td><?= h($comment->modified) ?></td>
                    <td class="actions">
                    <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $comment->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit')]) ?>
                    <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['action' => 'delete', $comment->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $comment->id)]) ?>
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
