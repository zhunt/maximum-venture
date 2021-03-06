<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Content Block'), ['action' => 'add']) ?></li>
    </ul>
</div>
<div class="contentBlocks index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('flag_html') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($contentBlocks as $contentBlock): ?>
        <tr>
            <td><?= $this->Number->format($contentBlock->id) ?></td>
            <td><?= h($contentBlock->name) ?></td>
            <td><?= h($contentBlock->flag_html) ?></td>
            <td><?= h($contentBlock->created) ?></td>
            <td><?= h($contentBlock->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $contentBlock->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $contentBlock->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id)]) ?>
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
