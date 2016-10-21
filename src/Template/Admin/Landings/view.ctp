<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Landing'), ['action' => 'edit', $landing->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Landing'), ['action' => 'delete', $landing->id], ['confirm' => __('Are you sure you want to delete # {0}?', $landing->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Landings'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Landing'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Page Types'), ['controller' => 'PageTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Page Type'), ['controller' => 'PageTypes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="landings view large-10 medium-9 columns">
    <h2><?= h($landing->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Page Name') ?></h6>
            <p><?= h($landing->page_name) ?></p>
            <h6 class="subheader"><?= __('Seo Title') ?></h6>
            <p><?= h($landing->seo_title) ?></p>
            <h6 class="subheader"><?= __('Page Type') ?></h6>
            <p><?= $landing->has('page_type') ? $this->Html->link($landing->page_type->name, ['controller' => 'PageTypes', 'action' => 'view', $landing->page_type->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Block 1 Title') ?></h6>
            <p><?= h($landing->block_1_title) ?></p>
            <h6 class="subheader"><?= __('Block 2 Title') ?></h6>
            <p><?= h($landing->block_2_title) ?></p>
            <h6 class="subheader"><?= __('Block 3 Title') ?></h6>
            <p><?= h($landing->block_3_title) ?></p>
            <h6 class="subheader"><?= __('Block 4 Title') ?></h6>
            <p><?= h($landing->block_4_title) ?></p>
            <h6 class="subheader"><?= __('Block 5 Title') ?></h6>
            <p><?= h($landing->block_5_title) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($landing->id) ?></p>
            <h6 class="subheader"><?= __('Seo Desc') ?></h6>
            <p><?= $this->Number->format($landing->seo_desc) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Block 1 Content') ?></h6>
            <?= $this->Text->autoParagraph(h($landing->block_1_content)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Block 2 Content') ?></h6>
            <?= $this->Text->autoParagraph(h($landing->block_2_content)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Block 3 Content') ?></h6>
            <?= $this->Text->autoParagraph(h($landing->block_3_content)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Block 4 Content') ?></h6>
            <?= $this->Text->autoParagraph(h($landing->block_4_content)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Block 5 Content') ?></h6>
            <?= $this->Text->autoParagraph(h($landing->block_5_content)); ?>

        </div>
    </div>
</div>
