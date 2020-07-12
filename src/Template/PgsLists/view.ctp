<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PgsList $pgsList
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Pgs List'), ['action' => 'edit', $pgsList->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Pgs List'), ['action' => 'delete', $pgsList->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pgsList->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Pgs Lists'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pgs List'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Pgs'), ['controller' => 'Pgs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Pg'), ['controller' => 'Pgs', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="pgsLists view large-9 medium-8 columns content">
    <h3><?= h($pgsList->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($pgsList->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subtitle') ?></th>
            <td><?= h($pgsList->subtitle) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($pgsList->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pg') ?></th>
            <td><?= $pgsList->has('pg') ? $this->Html->link($pgsList->pg->name, ['controller' => 'Pgs', 'action' => 'view', $pgsList->pg->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($pgsList->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($pgsList->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($pgsList->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($pgsList->description)); ?>
    </div>
</div>
