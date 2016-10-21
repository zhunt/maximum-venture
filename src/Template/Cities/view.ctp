    <?php $this->assign('title', 'Bartending School in ' . $city->name . ', ' . $city->province->name ); ?>

    <?php $this->assign('meta_description', 'List of Bartending Schools and Courses in ' . $city->name . ', ' . $city->province->name . ', ' . $city->country->name ); ?>
    <?php $this->assign('canonical', $city->canonical  ); ?>

<!-- ==========================
        BREADCRUMB - START 
    =========================== -->
    <section class="breadcrumb-wrapper">
        <div class="container">
            <h2>Bartending Schools and Courses : <?= $city->name ?></h2>
            <ol class="breadcrumb">
                <li><a href="/cities/">Cities</a></li>
                <li class="active"><?= h($city->name) ?></li>
            </ol>
        </div>
    </section>
    <!-- ==========================
        BREADCRUMB - END 
    =========================== -->

    <!-- ==========================
        PORTFOLIO - START 
    =========================== -->
    <section class="content bg-color-2 portfolio-col-3" id="portfolio">
        <div class="container">
            <div class="isotope-filter portfolio-filter">
                <h1>List of <?= count($city->schools) ?> Bartending Schools in <b><?= h($city->name . ', ' . $city->province->name) ?></b></h1>

                <?php if ( !empty($city->city_text) ) { echo $city->city_text; } ?>
            </div>

            <?php if ( !empty($city->city_text) ): ?>

            <div class="ab1 center-block col-lg-12" style="margin: -2em auto 2em;float:none;max-width:790px;overflow:visible">
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

            <?php endif; ?>
            
            <div class="row portfolio-wrapper">

            <?php if (!empty($city->schools)): ?>


                <?php foreach ($city->schools as $schools): ?>
                    <?php if ( empty($schools->logo_id) ): ?>
                    <!-- PORTFOLIO ITEM -->
                    <div class="col-md-4 portfolio-item ">
                        <article>
                            <div class="portfolio-item-description">
                                <h3><a href="/school/<?= $schools->slug ?>"><?= h($schools->name) ?></a></h3>
                                <p><?= h($schools->address) ?></p>
                                <a href="/school/<?= $schools->slug ?>" class="btn danger center">More</a>
                            </div>
                        </article>
                    </div>
                    <?php else: ?>
                    <!-- PORTFOLIO ITEM IMG -->
                    <div class="col-md-4 portfolio-item design ">
                        <article>
                            <div class="overlay-wrapper" ahref="#">
                                <?php $imageData = json_decode( $schools->image_upload->file_meta ); ?>
                                <img src="/img/<?= $imageData->sizes->home->filename ?> " class="img-responsive" alt="">
                            </div>
                            <div class="portfolio-item-description">
                                <h3><a href="/school/<?= $schools->slug ?>"><?= h($schools->name) ?></a></h3>
                                <p><?= h($schools->address) ?></p>
                                <p><br><a href="/school/<?= $schools->slug ?>" class="btn danger text-center"> <i class="fa fa-chevron-right"></i> More</a></p>

                            </div>
                        </article>
                    </div>
                    <?php endif; ?>
                <?php endforeach ?>
            <?php endif; ?>

            </div> <!-- end portfolio wrapper -->
            
        </div>
    </section>
    <!-- ==========================
        PORTFOLIO - END 
    =========================== --> 

    <section class="content">
    <div class="ab1 center-block col-lg-12" style="float:none;max-width:790px;overflow:visible">
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


