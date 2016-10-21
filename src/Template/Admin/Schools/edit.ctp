<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $school->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $school->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Schools'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Image Uploads'), ['controller' => 'ImageUploads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Upload'), ['controller' => 'ImageUploads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Chains'), ['controller' => 'Chains', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Chain'), ['controller' => 'Chains', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cities'), ['controller' => 'Cities', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New City'), ['controller' => 'Cities', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="schools form large-10 medium-9 columns">
    <?= $this->Form->create($school); ?>
    <fieldset>
        <legend><?= __('Edit School') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
            echo $this->Form->input('seo_title');
            
            echo $this->Form->input('address');
            echo $this->Form->input('phone_1');
            echo $this->Form->input('phone_2');
            echo $this->Form->input('website_1_url');
            echo $this->Form->input('website_2_url');
            echo $this->Form->input('logo_id', ['options' => $imageUploads, 'empty' => true]);
            echo $this->Form->input('description');
            echo '<a href="http://markitdown.medusis.com/" target="_blank">Markdown</a>'; 
            echo $this->Form->input('chain_id', ['options' => $chains, 'empty' => true]);
            echo $this->Form->input('city_id', ['options' => $cities]);
            echo $this->Form->input('geo_latt');
            echo $this->Form->input('geo_long');
            echo '<a href="http://gmaps-samples.googlecode.com/svn/trunk/geocoder/singlegeocode.html" target="_blank">GeoCode</a>';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
