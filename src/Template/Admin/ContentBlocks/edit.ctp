<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $contentBlock->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="contentBlocks form large-10 medium-9 columns">
    <?= $this->Form->create($contentBlock); ?>
    <fieldset>
        <legend><?= __('Edit Content Block') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('content');
            echo $this->Form->input('flag_html');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
