<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit School'), ['action' => 'edit', $school->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete School'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Schools'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New School'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Image Uploads'), ['controller' => 'ImageUploads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Upload'), ['controller' => 'ImageUploads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Chains'), ['controller' => 'Chains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chain'), ['controller' => 'Chains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="schools view large-10 medium-9 columns">
    <h2><?= h($school->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($school->name) ?></p>
            <h6 class="subheader"><?= __('Phone 1') ?></h6>
            <p><?= h($school->phone_1) ?></p>
            <h6 class="subheader"><?= __('Phone 2') ?></h6>
            <p><?= h($school->phone_2) ?></p>
            <h6 class="subheader"><?= __('Website 1 Url') ?></h6>
            <p><?= h($school->website_1_url) ?></p>
            <h6 class="subheader"><?= __('Website 2 Url') ?></h6>
            <p><?= h($school->website_2_url) ?></p>
            <h6 class="subheader"><?= __('Image Upload') ?></h6>
            <p><?= $school->has('image_upload') ? $this->Html->link($school->image_upload->filename, ['controller' => 'ImageUploads', 'action' => 'view', $school->image_upload->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Chain') ?></h6>
            <p><?= $school->has('chain') ? $this->Html->link($school->chain->name, ['controller' => 'Chains', 'action' => 'view', $school->chain->id]) : '' ?></p>
            <h6 class="subheader"><?= __('City') ?></h6>
            <p><?= $school->has('city') ? $this->Html->link($school->city->name, ['controller' => 'Cities', 'action' => 'view', $school->city->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($school->id) ?></p>
            <h6 class="subheader"><?= __('Geo Latt') ?></h6>
            <p><?= $this->Number->format($school->geo_latt) ?></p>
            <h6 class="subheader"><?= __('Geo Long') ?></h6>
            <p><?= $this->Number->format($school->geo_long) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Address') ?></h6>
            <?= $this->Text->autoParagraph(h($school->address)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($school->description)); ?>

        </div>
    </div>
</div>
