<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pg $pg
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pg'), ['action' => 'edit', $pg->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pg'), ['action' => 'delete', $pg->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pg->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pgs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pg'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Parent Pgs'), ['controller' => 'Pgs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Parent Pg'), ['controller' => 'Pgs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Child Pgs'), ['controller' => 'Pgs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Child Pg'), ['controller' => 'Pgs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pgs view large-9 medium-8 columns content">
    <h3><?= h($pg->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $pg->has('user') ? $this->Html->link($pg->user->name, ['controller' => 'Users', 'action' => 'view', $pg->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Parent Pg') ?></th>
            <td><?= $pg->has('parent_pg') ? $this->Html->link($pg->parent_pg->name, ['controller' => 'Pgs', 'action' => 'view', $pg->parent_pg->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($pg->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pg->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lft') ?></th>
            <td><?= $this->Number->format($pg->lft) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Rght') ?></th>
            <td><?= $this->Number->format($pg->rght) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= $this->Number->format($pg->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Body') ?></th>
            <td><?= $this->Number->format($pg->body) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Published') ?></th>
            <td><?= $this->Number->format($pg->published) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pg->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pg->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Pgs') ?></h4>
        <?php if (!empty($pg->child_pgs)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Body') ?></th>
                <th scope="col"><?= __('Published') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($pg->child_pgs as $childPgs): ?>
            <tr>
                <td><?= h($childPgs->id) ?></td>
                <td><?= h($childPgs->user_id) ?></td>
                <td><?= h($childPgs->parent_id) ?></td>
                <td><?= h($childPgs->slug) ?></td>
                <td><?= h($childPgs->lft) ?></td>
                <td><?= h($childPgs->rght) ?></td>
                <td><?= h($childPgs->name) ?></td>
                <td><?= h($childPgs->body) ?></td>
                <td><?= h($childPgs->published) ?></td>
                <td><?= h($childPgs->created) ?></td>
                <td><?= h($childPgs->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Pgs', 'action' => 'view', $childPgs->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Pgs', 'action' => 'edit', $childPgs->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Pgs', 'action' => 'delete', $childPgs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childPgs->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
