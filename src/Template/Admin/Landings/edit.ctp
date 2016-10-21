<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $landing->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $landing->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Landings'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="landings form large-10 medium-9 columns">
    <?= $this->Form->create($landing); ?>
    <fieldset>
        <legend><?= __('Edit Landing') ?></legend>
        <?php
            echo $this->Form->input('page_name');
            echo $this->Form->input('seo_title');
            echo $this->Form->input('seo_desc');
            echo $this->Form->input('page_type_id', ['options' => $pageTypes]);
            echo $this->Form->input('block_1_title');
            echo $this->Form->input('block_1_content');
            echo $this->Form->input('block_2_title');
            echo $this->Form->input('block_2_content');
            echo $this->Form->input('block_3_title');
            echo $this->Form->input('block_3_content');
            echo $this->Form->input('block_4_title');
            echo $this->Form->input('block_4_content');
            echo $this->Form->input('block_5_title');
            echo $this->Form->input('block_5_content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
