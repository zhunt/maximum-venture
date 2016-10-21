<?php
use Cake\I18n\Time;
$articleDate = Time::parse( $article->created ); 
?>
<div class="grid-boxes-in">
    <?php 
    if ( !empty($article->image_upload) ) { 
        $imageJson = json_decode($article->image_upload->file_meta, true); //debug($article->image_upload);
        echo '<a href="/article/' . $article->slug . '"><img class="img-responsive" src="/img/' . $imageJson['sizes']['blog_thumb']['filename'] . '" alt="' . $imageJson['name'] .'" title="' . h($article->image_upload->name) . '" /></a>'; 
    } ?>    
    <div class="grid-boxes-caption">
        <div class="easy-block-v1">
        <div class="easy-block-v1-badge easy-block-v1-badge-2">
            <div class="badge-block" style="background-color:#<?= $article->category->colour ?>;color:#<?= $article->category->text_colour ?>"><?= $article->category->name ?></div>
            <?php if ( isset($article->categories2->name) && !empty($article->categories2->name) ): ?>
            <div style="border-radius:2px;background-color:#<?= $article->categories2->colour ?>;color:#<?= $article->categories2->text_colour ?>;"><?= $article->categories2->name ?></div>
            <?php endif; ?>
        </div>
        </div>

        <h3><a href="/article/<?= $article->slug ?>"><?= $article->name ?></a></h3>
        <ul class="list-inline grid-boxes-news">
            <li><span>By</span> <a href="#">Staff</a></li>
            <li>|</li>
            <li><i class="fa fa-clock-o"></i> <?= $articleDate->format('j-M-y'); ?> </li>
            <li>|</li>
            <li>
                <a href="#"><i class="fa fa-comments-o"></i> <a href="/article/<?= $article->slug ?>#disqus_thread" data-disqus-identifier="<?= $article->slug ?>"></a></a></li>
        </ul>
        <p><?= $article->feature_text ?></p>
    </div>
</div>

