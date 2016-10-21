<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Provinces'), ['controller' => 'Provinces', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Province'), ['controller' => 'Provinces', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Countries'), ['controller' => 'Countries', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Country'), ['controller' => 'Countries', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cities view large-10 medium-9 columns">
    <h2><?= h($city->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Slug') ?></h6>
            <p><?= h($city->slug) ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($city->name) ?></p>
            <h6 class="subheader"><?= __('Province') ?></h6>
            <p><?= $city->has('province') ? $this->Html->link($city->province->name, ['controller' => 'Provinces', 'action' => 'view', $city->province->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Country') ?></h6>
            <p><?= $city->has('country') ? $this->Html->link($city->country->name, ['controller' => 'Countries', 'action' => 'view', $city->country->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($city->id) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Flag Featured') ?></h6>
            <p><?= $city->flag_featured ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Schools') ?></h4>
    <?php if (!empty($city->schools)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Address') ?></th>
            <th><?= __('Phone 1') ?></th>
            <th><?= __('Phone 2') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Chain Id') ?></th>
            <th><?= __('City Id') ?></th>
            <th><?= __('Geo Latt') ?></th>
            <th><?= __('Geo Long') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($city->schools as $schools): ?>
        <tr>
            <td><?= h($schools->id) ?></td>
            <td><?= h($schools->name) ?></td>
            <td><?= h($schools->address) ?></td>
            <td><?= h($schools->phone_1) ?></td>
            <td><?= h($schools->phone_2) ?></td>
            <td><?= h($schools->description) ?></td>
            <td><?= h($schools->chain_id) ?></td>
            <td><?= h($schools->city_id) ?></td>
            <td><?= h($schools->geo_latt) ?></td>
            <td><?= h($schools->geo_long) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Schools', 'action' => 'view', $schools->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Schools', 'action' => 'edit', $schools->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schools', 'action' => 'delete', $schools->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schools->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
