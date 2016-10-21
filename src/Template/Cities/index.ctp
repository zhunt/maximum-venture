
<?php $this->assign('title', 'Cities with bartending schools ' . $this->Paginator->counter()  ); ?>
<?php $this->assign('meta_description', 'Bartending school cities' ); ?>
<?php $this->assign('meta_index', 'noindex, follow' ); // e.g. for category pages ?>


    <!-- ==========================
        SEARCH - START 
    =========================== -->
    <section class="content" id="search-results">
        <div class="container">
            <h2>Cities</b></h2>
            <div class="row">
                <?php //debug($cities) ?>
                <!-- SEARCH RESULT - START -->
                <?php foreach ($cities as $city): ?>
                <div class="col-sm-6">
                    <div class="search-result">
                        <div class="row">
                            <?php 
                            /*
                            if ( $article->feature_image_id > 0 ) {
                                $thumbImage = json_decode( $article->image_upload->file_meta,true);
                                $thumbImage = $thumbImage['sizes']['home']['filename'];
                                //debug($thumbImage); 

                                if ($thumbImage) {
                                    echo '<div class="col-sm-5">';
                                    echo '<a href="/article/' . $article->slug . '"><img src="/img/' .$thumbImage .'" class="img-responsive" alt="' . $article->name . ' photo"></a>';
                                    echo '</div>';
                                }
                            }else { */
                                    echo '<div class="col-sm-5">';
                                    echo '<a href="/city/' . $city->slug . '"><img src="/image/image_01.jpg" class="img-responsive" alt="' . $city->name . ' photo"></a>';
                                    echo '</div>';                                
                            //}                          
                            ?>
                            

                            <div class="col-sm-7">
                                <h3><a href="/city/<?= $city->slug ?>"><?= h($city->name) ?></a></h3>
                                <p><?= $city->province->name . ', ' .$city->country->name ?></p>
                            </div>
                        </div>
                        <!-- div class="search-info"><span>Technologies</span> - <span>11/10/2014</span> - <span><a href="#">John Doe</a></span></div -->
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- SEARCH RESULT - END -->
                
             
                
            </div>
            
            <!-- PAGINATION - START -->

    
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <!-- <p><?= $this->Paginator->counter() ?></p> -->
   

            <!-- PAGINATION - END -->
        </div>
    </section>
    <!-- ==========================
        SEARCH - END 
    =========================== -->

    <section class="content">
    <div class="ab1 center-block col-lg-8">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- bartenderTraining-adblock1 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5569648086666006"
             data-ad-slot="5270749504"
             data-ad-format="auto"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    </section>

