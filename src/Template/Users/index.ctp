<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
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
            <?= $this->Html->link(__('New User'), ['action' => 'add'],["class"=>"btn btn-outline-primary btn-rounded waves-light waves-effect width-md float-right"]) ?>
            <h4 class="header-title"><b><?= __('Users') ?></b></h4>
            <p class="sub-header"><?= __('Users') ?> <?= __('List') ?></p>
            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                                            <th scope="col"><?= __('id') ?></th>
                                            <th scope="col"><?= __('email') ?></th>
                                            <th scope="col"><?= __('password') ?></th>
                                            <th scope="col"><?= __('name') ?></th>
                                            <th scope="col"><?= __('role') ?></th>
                                            <th scope="col"><?= __('created') ?></th>
                                            <th scope="col"><?= __('modified') ?></th>
                                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                                                                                                                                                                                    <td><?= $this->Number->format($user->id) ?></td>
                                                                                                                                                                                                                                        <td><?= h($user->email) ?></td>
                                                                                                                                                                                                                                        <td><?= h($user->password) ?></td>
                                                                                                                                                                                                                                        <td><?= h($user->name) ?></td>
                                                                                                                                                                                                                                        <td><?= h($user->role) ?></td>
                                                                                                                                                                                                                                        <td><?= h($user->created) ?></td>
                                                                                                                                                                                                                                        <td><?= h($user->modified) ?></td>
                                                                                                                <td class="actions">
                        <?= $this->Html->link('<i class="fas fa-pencil-alt"></i>', ['action' => 'edit', $user->id], ['class'=>'btn btn-icon waves-effect waves-light btn-primary btn-sm','escape'=>false,'alt'=>__('Edit')]) ?>
                        <?= $this->Form->postLink('<i class="fas fa-times"></i>', ['action' => 'delete', $user->id], ['class'=>'btn btn-icon waves-effect waves-light btn-danger btn-sm','escape'=>false,'alt'=>__('Delete'),'confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
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
