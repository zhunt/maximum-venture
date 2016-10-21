<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $chain->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $chain->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Chains'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['controller' => 'Schools', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['controller' => 'Schools', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="chains form large-10 medium-9 columns">
    <?= $this->Form->create($chain); ?>
    <fieldset>
        <legend><?= __('Edit Chain') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('canonical_link');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
