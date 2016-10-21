<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New School'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Image Uploads'), ['controller' => 'ImageUploads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Upload'), ['controller' => 'ImageUploads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Chains'), ['controller' => 'Chains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chain'), ['controller' => 'Chains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="schools index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('phone_1') ?></th>
            <th><?= $this->Paginator->sort('phone_2') ?></th>
            <th><?= $this->Paginator->sort('website_1_url') ?></th>
            <th><?= $this->Paginator->sort('website_2_url') ?></th>
            <th><?= $this->Paginator->sort('city_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($schools as $school): ?>
        <tr>
            <td><?= $this->Number->format($school->id) ?></td>
            <td><?= h($school->name) ?></td>
            <td><?= h($school->phone_1) ?></td>
            <td><?= h($school->phone_2) ?></td>
            <td><?= h($school->website_1_url) ?></td>
            <td><?= h($school->website_2_url) ?></td>
            <td>
                

                <?php echo $school->city->name ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $school->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $school->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id)]) ?>
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
