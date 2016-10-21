<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Content Block'), ['action' => 'edit', $contentBlock->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Content Block'), ['action' => 'delete', $contentBlock->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contentBlock->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Content Blocks'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Content Block'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="contentBlocks view large-10 medium-9 columns">
    <h2><?= h($contentBlock->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($contentBlock->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($contentBlock->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($contentBlock->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($contentBlock->modified) ?></p>
        </div>
        <div class="large-2 columns booleans end">
            <h6 class="subheader"><?= __('Flag Html') ?></h6>
            <p><?= $contentBlock->flag_html ? __('Yes') : __('No'); ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Content') ?></h6>
            <?= $this->Text->autoParagraph(h($contentBlock->content)); ?>

        </div>
    </div>
</div>
