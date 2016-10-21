<?php use Cake\Core\Configure;
use Cake\I18n\Time; 
$articleDate = Time::parse( $article->created ); 
?>
<?php $this->assign('title', h($article->seo_title) );// . ' | ' . Configure::read('websiteName') ); ?>
<?php $this->assign('meta_description', $article->seo_desc ); ?>
<?php $this->assign('canonical',  $canonical ); ?>
<?php if ( !empty($article->social_image_url) ) { $this->assign('social_image_url',  $article->social_image_url ); } ?>
<?php if ( !empty($article->feature_text) ) { $this->assign('social_description',  $article->feature_text ); } ?>
<?php if ( !empty($article->name) ) { $this->assign('social_name',  $article->name ); } ?>
<?php $this->assign('ogType',  'article' ) ?>
<?php $this->assign('articleDate', $article->created ) ?>
<?php $this->assign('articleCategory', $article->category->name ) ?>
<?php $this->assign('articleSubhead', $article->subhead ) ?>
   
<?php // debug($article); ?>
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left article-title"><?= h($article->name) ?></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="/">Home</a></li>
                
                <li><a href="/category/<?= $article->category->slug; ?>/"><?= h($article->category->name) ?></a></li>
                <?php if ( isset($article->categories2->id) ):?>
                <li class="active"><a href="/category/<?= $article->categories2->slug; ?>/"><?= h($article->categories2->name) ?></a></li>
                <?php endif; ?>
               
            </ul>
        </div>
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">

        <div class="row blog-page blog-item">

            <!-- Left Sidebar -->
            <div class="col-md-9 md-margin-bottom-60">



                <!--Blog Post-->
                <div class="blog margin-bottom-40">
                    <?php if ( $article->subhead): ?>    
                    <h2><a href="<?= $canonical ?>"><?= h($article->subhead) ?></a></h2>
                    <?php endif; ?>


                    <div class="blog-post-tags">
                        <ul class="list-unstyled list-inline blog-info">
                            <li><i class="fa fa-calendar"></i> <?= $articleDate->format('j-M-y'); ?></li>
                            <li><i class="fa fa-pencil"></i> 
                                <?php if ( empty($article->author) ){
                                    echo 'Staff';
                                } else {
                                    if (!empty( $article->author_url) ){
                                        echo "<a href=\"{$article->author_url}\" rel=\"nofollow\">" . h($article->author) . '</a>';
                                    }else {
                                        echo h($article->author);    
                                    }
                                }?>
                            </li>
                            <li><i class="fa fa-comments"></i> <a href="#disqus_thread"><span class="disqus-comment-count" data-disqus-identifier="<?= h($article->slug); ?>"></span></a></li>

                            

                        </ul>
                        <ul class="list-unstyled list-inline blog-tags">
                            <li>
                                <?php if ( isset($article->tags) ):?>
                                <i class="fa fa-tags"></i>
                                <?php foreach($article->tags as $tag): //debug($tag); ?>
                                <a href="/tag/<?= $tag->slug ?>" title="<?= h($tag->meta_desc) ?>"><?= h($tag->title) ?></a>
                                <?php endforeach;?>
                                <?php endif;?>
                            </li>
                        </ul>
                    </div>
                    
                    
                    <?php //debug($article);
                    if ( !empty($article->image_upload) ) : ?>
                    <div class="blog-img">
                    <?php 
                    $imageJson = json_decode($article->image_upload->file_meta, true); //debug($imageJson);
                    $this->assign('social_image_url', Configure::read('siteUrlFull') . '/img/' . $imageJson['sizes']['social']['filename'] ); // also override the social image url if here
                    echo '<img class="img-responsive" src="/img/' . $imageJson['sizes']['blog_large']['filename'] . '" alt="' . h($imageJson['name']) . '" />'; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($authUser){ echo "<p><a href='/admin/articles/edit/{$article->id}' target='_blank'>Edit</a></p>";}?>
                    
                    <ins class=adsbygoogle style="float:left;width:336px;height:280px;margin:.5em .5em 0 0" data-ad-client=ca-pub-5569648086666006 data-ad-slot=8475068701></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script>                    

                 
                    <?= $article->body; ?>

                    <ins class=adsbygoogle style="margin:0 auto;width:336px;height:280px;" data-ad-client=ca-pub-5569648086666006 data-ad-slot=8475068701></ins><script>(adsbygoogle=window.adsbygoogle||[]).push({});</script> 


                    <?php //debug($article);
                    $SuggestArticlesCell = $this->cell('SuggestArticle', [ 
                        'num' => 3, 
                        'articleId' => $article->id,
                        'articleCat1Id' => $article->category,
                        'articleCat2Id' => $article->categories2,
                        'tags' => $article->tags
                        ] ); 
                    echo $SuggestArticlesCell;

                    /*
    echo $this->cache(function () {
        echo $this->cell('Navbar');
    }, ['key' => 'main_navbar']);

                    */
                    ?>
                    
                    


                    


                </div>
                <!--End Blog Post-->

                <hr>
                <!-- comment form here -->

                



                <div name="disqus_thread" id="disqus_thread"></div>
                <script>
                /**
                * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
                */
                
                var disqus_config = function () {
                this.page.url = "<?= $canonical ?>"; // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = "<?= h($article->slug) ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                
                (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');

                s.src = '//maximumventure.disqus.com/embed.js';

                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
                })();
                </script>
                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

                <!-- End Comment Form -->
            </div>
            <!-- End Left Sidebar -->

            <!-- Right Sidebar -->
            <div class="col-md-3 magazine-page">



                <!-- Search Bar -->
                <!--
                <div class="headline headline-md"><h2>Search</h2></div>
                <div class="input-group margin-bottom-40">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn-u" type="button">Go</button>
                    </span>
                </div>
                -->
                <!-- End Search Bar -->

                <!-- Posts -->
                <?php if ( !empty($companiesList) ):?>
                <div class="posts margin-bottom-40">
                    <div class="headline headline-md"><h2>Companies Mentioned</h2></div>

                    <?php foreach( $companiesList as $company ): //debug($tag->company); ?>
                    <dl class="dl-horizontal">
                        <!-- dt><a href="#"><img src="/assets/img/sliders/elastislide/6.jpg" alt="" /></a></dt -->
                        <dd style="font-size: 12px; margin-left: 0">
                            <p><b><a href="#"><?= h($company['name'] ) ?></a></b></p>
                            <?= $company['description'] ?>
                            <!--
                            <p>Industry: <a href="#">Repairs</a></p>
                            <p>Headquarters: <a href="#">Toronto</a></p>
                            -->
                        </dd>                    
                    </dl>

                    <?php endforeach; ?>
<!--
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/10.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">100+ Amazing Features Layer Slider, Layer Slider, Icons, 60+ Pages etc.</a></p>
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img src="assets/img/sliders/elastislide/11.jpg" alt="" /></a></dt>
                        <dd>
                            <p><a href="#">Developer Friendly Code imperdiet condime ntumi mperdiet condim.</a></p>
                        </dd>
                    </dl>
                -->
                </div>
                <?php endif; ?>
                <!--/posts-->
                <!-- End Posts -->

                <!-- Vancouver2Toronto -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-5569648086666006"
                     data-ad-slot="4886244305"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>                

               

               

                <!-- Blog Tags -->
                <!-- 
                <div class="headline headline-md"><h2>Blog Tags</h2></div>
                <ul class="list-unstyled blog-tags margin-bottom-30">
                    <li><a href="#"><i class="fa fa-tags"></i> Business</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Music</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Internet</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Money</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Google</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> TV Shows</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Education</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> People</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> People</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Math</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Photos</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Electronics</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Apple</a></li>
                    <li><a href="#"><i class="fa fa-tags"></i> Canada</a></li>
                </ul>
                -->
                <!-- End Blog Tags -->

                <!-- Blog Latest Tweets -->
                <!-- 
                <div class="blog-twitter margin-bottom-30">
                    <div class="headline headline-md"><h2>Latest Tweets</h2></div>
                    <div class="blog-twitter-inner">
                        <i class="fa fa-twitter"></i>
                        <a href="#">@htmlstream</a>
                        At vero eos et accusamus et iusto odio dignissimos.
                        <a href="#">http://t.co/sBav7dm</a>
                        <span>5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="fa fa-twitter"></i>
                        <a href="#">@htmlstream</a>
                        At vero eos et accusamus et iusto odio dignissimos.
                        <a href="#">http://t.co/sBav7dm</a>
                        <span>5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="fa fa-twitter"></i>
                        <a href="#">@htmlstream</a>
                        At vero eos et accusamus et iusto odio dignissimos.
                        <a href="#">http://t.co/sBav7dm</a>
                        <span>5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="fa fa-twitter"></i>
                        <a href="#">@htmlstream</a>
                        At vero eos et accusamus et iusto odio dignissimos.
                        <a href="#">http://t.co/sBav7dm</a>
                        <span>5 hours ago</span>
                    </div>
                </div>
                -->
                <!-- End Blog Latest Tweets -->
            </div>
            <!-- End Right Sidebar -->
        </div><!--/row-->
    </div><!--/container-->
    <!--=== End Content Part ===-->


       
      
