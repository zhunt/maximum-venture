<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Image Upload'), ['action' => 'edit', $imageUpload->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Image Upload'), ['action' => 'delete', $imageUpload->id], ['confirm' => __('Are you sure you want to delete # {0}?', $imageUpload->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Image Uploads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Upload'), ['action' => 'add']) ?> </li>
    </ul>
</div>
<div class="imageUploads view large-10 medium-9 columns">
    <h2><?= h($imageUpload->id) ?>, <?= h($imageUpload->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Filename') ?></h6>
            <p> <img src="/img/<?= $imageUpload->filename ?>" alt="<?= $imageUpload->filename ?>" title="<?= $imageUpload->name ?>" /></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($imageUpload->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($imageUpload->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($imageUpload->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('File Meta') ?></h6>
            <?= $this->Text->autoParagraph(h($imageUpload->file_meta)); ?>

        </div>
    </div>
</div>
