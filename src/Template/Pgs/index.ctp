<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pg[]|\Cake\Collection\CollectionInterface $pgs
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pg'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pgs index large-9 medium-8 columns content">
    <h3><?= __('Pgs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('parent_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('body') ?></th>
                <th scope="col"><?= $this->Paginator->sort('published') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pgs as $pg): ?>
            <tr>
                <td><?= $this->Number->format($pg->id) ?></td>
                <td><?= $pg->has('user') ? $this->Html->link($pg->user->id, ['controller' => 'Users', 'action' => 'view', $pg->user->id]) : '' ?></td>
                <td><?= $pg->has('parent_pg') ? $this->Html->link($pg->parent_pg->name, ['controller' => 'Pgs', 'action' => 'view', $pg->parent_pg->id]) : '' ?></td>
                <td><?= h($pg->slug) ?></td>
                <td><?= $this->Number->format($pg->name) ?></td>
                <td><?= $this->Number->format($pg->body) ?></td>
                <td><?= $this->Number->format($pg->published) ?></td>
                <td><?= h($pg->created) ?></td>
                <td><?= h($pg->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pg->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pg->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pg->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pg->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>
