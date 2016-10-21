<?php use Cake\Core\Configure; 
$pagesCount = '';
if ( !empty( $this->request->query('page') ) ) {
    $pagesCount = $this->Paginator->counter(' | {{page}}-{{pages}}');
}
$this->assign('title', Configure::read('slogan1') . $pagesCount . ' | '  . Configure::read('websiteName') ); 
$this->assign('meta_description', Configure::read('websiteName') . ' is a currated list of ' . Configure::read('slogan1') . ' stories.' ); 
$this->assign('canonical',  $canonical ); 

$this->assign('criticalCss', true);
?>

        <!--=== End Header ===-->

    <!-- Interactive Slider v2 -->
    <!--
    <div class="interactive-slider-v2">
        <div class="container">
            <h1>Welcome to Unify</h1>
            <p>Clean and fully responsive Template.</p>
        </div>
    </div>
    -->
    <!-- End Interactive Slider v2 -->

    <?php //debug($articles); ?>


    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Latest <?= Configure::read('slogan1') ?></h1>
            <!--
            <ul class="pull-right breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="">Portfolio</a></li>
                <li class="active">Blog</li>
            </ul>
        -->
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="blog_masonry_3col">
        <div class="container content grid-boxes">


        <?php $loopCounter = 1; $adCounter = 0;?>    
        <?php foreach ($articles as $article): //debug($article); exit; ?>

             <?php if ( ($loopCounter % 3 == 0 ) && ( $adCounter < 3 ) ) : //  ?>
            <div class="grid-boxes-in"> 
            
                <ins class="adsbygoogle"
                     style="display:block;width:336px;height:280px; margin: auto;"
                     data-ad-client="ca-pub-5569648086666006"
                     data-ad-slot="8475068701"></ins>
                <script> 
                // MaximumVenture - 336x280 square
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
           
            </div>   
            <?php $adCounter++; ?>
            <?php endif; ?> 
                   
            <?php echo $this->element('article_box', [ 'article' => $article] , ['cache' => ['key' => 'article_box_' . $article->id ] ] ); ?>
            
            <?php $loopCounter++; ?>      
        <?php endforeach; ?>


          
            <!--
            <div class="grid-boxes-in"> 
                    
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block;width:336px;height:280px; margin: auto"
                     data-ad-client="ca-pub-5569648086666006"
                     data-ad-slot="8475068701"></ins>
                <script> 
                // MaximumVenture - 336x280 square
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            
            </div>
            -->

           



        </div><!--/container-->

    </div> <!-- end of massonary class-->
    <!--=== End Content Part ===-->

    <!--Pagination-->
    <div class="text-center">
    
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
            </ul>
            <p><?= $this->Paginator->counter() ?></p>
        </div>

<!--
        <ul class="pagination">
            <li><a href="#">«</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li class="active"><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">7</a></li>
            <li><a href="#">8</a></li>
            <li><a href="#">»</a></li>
        </ul>

    -->

    </div>
    <!--End Pagination-->


