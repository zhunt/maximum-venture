<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Content Blocks'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="contentBlocks form large-10 medium-9 columns">
    <?= $this->Form->create($contentBlock); ?>
    <fieldset>
        <legend><?= __('Add Content Block') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('content');
            echo $this->Form->input('flag_html');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
