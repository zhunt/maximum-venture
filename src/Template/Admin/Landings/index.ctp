<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Landing'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="landings index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('page_name') ?></th>
            <th><?= $this->Paginator->sort('seo_title') ?></th>
            <th><?= $this->Paginator->sort('seo_desc') ?></th>
            <th><?= $this->Paginator->sort('page_type_id') ?></th>
            <th><?= $this->Paginator->sort('block_1_title') ?></th>
            <th><?= $this->Paginator->sort('block_2_title') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($landings as $landing): ?>
        <tr>
            <td><?= $this->Number->format($landing->id) ?></td>
            <td><?= h($landing->page_name) ?></td>
            <td><?= h($landing->seo_title) ?></td>
            <td><?= $this->Number->format($landing->seo_desc) ?></td>
            <td>
                <?= $landing->has('page_type') ? $this->Html->link($landing->page_type->name, ['controller' => 'PageTypes', 'action' => 'view', $landing->page_type->id]) : '' ?>
            </td>
            <td><?= h($landing->block_1_title) ?></td>
            <td><?= h($landing->block_2_title) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $landing->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $landing->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $landing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $landing->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
