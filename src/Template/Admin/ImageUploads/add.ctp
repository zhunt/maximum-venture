<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Image Uploads'), ['action' => 'index']) ?></li>
    </ul>
</div>
<div class="imageUploads form large-10 medium-9 columns">
    <?= $this->Form->create($imageUpload, ['type' => 'file'] ); ?>
    <fieldset>
        <legend><?= __('Add Image Upload') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('filename', ['type' => 'file']);
            echo $this->Form->input('file_meta' );
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
