<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $article->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $article->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Articles'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Image Uploads'), ['controller' => 'ImageUploads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image Upload'), ['controller' => 'ImageUploads', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="articles form large-10 medium-9 columns">
    <?= $this->Form->create($article); ?>
    <fieldset>
        <legend><?= __('Edit Article') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('slug');
            echo $this->Form->input('seo_title'); // under 55 chars
            echo $this->Form->input('seo_desc');
            echo $this->Form->input('social_image_url');
            echo $this->Form->input('subhead');
            echo $this->Form->input('flag_published');
            echo $this->Form->input('body', ['rows' => 10 ]);

            echo $this->Form->input('tag_string', ['type' => 'hidden']); // convert to select2

            echo $this->Form->input('tags_field', ['type' => 'select', 
                                                    'options' => $tags, 'id' => 'tags_field', 'multiple' => true, 'value' => $tagsUsed ] );
                      

            echo $this->Form->input('flag_html');
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('category_id_2', ['options' => $categories, 'empty' => '(choose one)', 'required' => false ]);


            echo $this->Form->input('flag_featured');
            echo $this->Form->input('feature_image_id', ['options' => $imageUploads, 'empty' => true]);
            echo $this->Form->input('feature_text');
            echo $this->Form->input('author');
            echo $this->Form->input('author_url');            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>


<?php $this->Html->script('https://code.jquery.com/jquery-2.2.0.min.js', ['block' => true]); ?>
<?php $this->Html->script('/js/select2.min.js', ['block' => true]); ?>
<?php $this->Html->script('/js/textcounter.min.js', ['block' => true]); ?>
<?php $this->Html->script('/js/admin.js', ['block' => true]); ?>

<?php $this->Html->css('/css/select2.min.css', ['block' => true]); ?>

