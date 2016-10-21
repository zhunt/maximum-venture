<!-- \src\Template\Cell\Topmenu\display.ctp -->

    <header class="navbar yamm navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="/" class="navbar-brand"><img src="/image/logo.png" class="header-logo" alt="BartenderTraining logo" title="Bartender Training"></a>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
            </div>
            <div class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav navbar-main-menu">

                    <li class="dropdown">
                        <a href="/">Home</a>
                        <!--
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Home <i class="fa fa-chevron-down"></i></a>
                       
                        <ul class="dropdown-menu">
                            <li><a href="index.html"><i class="fa fa-angle-double-right"></i>Default Option</a></li>
                            <li><a href="index-image.html"><i class="fa fa-angle-double-right"></i>Option 1 (Static Image)</a></li>
                            <li><a href="index-text.html"><i class="fa fa-angle-double-right"></i>Option 2 (Text Only)</a></li>
                            <li><a href="index-application.html"><i class="fa fa-angle-double-right"></i>Application<span class="label label-warning">updated</span></a></li>
                            <li><a href="index-product.html"><i class="fa fa-angle-double-right"></i>Product<span class="label label-warning">updated</span></a></li>
                            <li><a href="index-eshop.html"><i class="fa fa-angle-double-right"></i>Eshop<span class="label label-warning">updated</span></a></li>
                            <li><a href="index-coming-soon.html"><i class="fa fa-angle-double-right"></i>Coming Soon<span class="label label-warning">updated</span></a></li>
                            <li><a href="index-search.html"><i class="fa fa-angle-double-right"></i>Search</a></li>
                            <li><a href="index-portfolio.html"><i class="fa fa-angle-double-right"></i>Portfolio</a></li>
                            <li><a href="index-event.html"><i class="fa fa-angle-double-right"></i>Event<span class="label label-danger">new</span></a></li>
                        </ul>
                    -->
                    </li>
                    <!--
                    <li>
                        <a href="features.html">Blog</a>
                    </li>
                -->

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cities <i class="fa fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <?php foreach( $cityList as $city): ?>
                            <li><a href="/city/<?= $city->slug?>/"><i class="fa fa-angle-double-right"></i><?= $city->name ?></a></li>
                            <?php endforeach; ?>
                            <li><a href="/cities/"><i class="fa fa-angle-double-right"></i>More</a></li>
                            <!--
                            <li><a href="profile.html"><i class="fa fa-angle-double-right"></i>Montreal<span class="label label-danger">new</span></a></li>
                            <li><a href="search.html"><i class="fa fa-angle-double-right"></i>Calgary<span class="label label-danger">new</span></a></li>
                            <li><a href="pricing1.html"><i class="fa fa-angle-double-right"></i>Barrie</a></li>
                            -->
                        </ul>
                    </li>                   
                    
                    <!-- big menu -->
                    <li class="dropdown yamm-fw h/idden-xs h/idden-sm">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us <i class="fa fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="yamm-content">
                                    <div class="row">
                                        <div class="col-sm-6 hidden-xs hidden-sm">

                                            <h3><?php echo $article_name ?> <!-- Latest Bartending Blog --></h3>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img src="/img/<?php echo $feature_image ?>" class="img-responsive" alt="">
                                                    <a href="/article/<?php echo $article_slug ?>" class="btn btn-primary">Show Me</a>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b><?php echo $article_name ?></b><br><?php echo $feature_text ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <h3>Features Pages</h3>
                                            <ul class="nav vertical-nav">
                                                <li><a href="/page/about-us"><i class="fa fa-angle-double-right"></i>About Us</a></li>
                                                <li><a href="/city/toronto/"><i class="fa fa-angle-double-right"></i>Toronto Bartending Schools</a></li>
                                                <li><a href="/city/montreal/"><i class="fa fa-angle-double-right"></i>Montreal Bartending Schools</a></li>
                                                <li><a href="/city/vancouver/"><i class="fa fa-angle-double-right"></i>Vancouver Bartending Schools</a></li>
                                                <li><a href="/page/shop-home-page/"><i class="fa fa-angle-double-right"></i>Bartending Store</a></li>
                                                <!-- <li><a href="services1.html"><i class="fa fa-angle-double-right"></i>New York Bartending Schools <span class="label label-danger">new</span></a></li>
                                                -->
                                               
                                            </ul>
                                        </div>
                                        <div class="col-sm-3">
                                            <h3>About Us</h3>
                                            <p>BartenderTraining.ca is a guide to the many bartending schools across Canada from Toronto to Vancouver, Calgary to Halifax, Montreal to Winnipeg with full descriptions and contact information. We'll also have information on writing resumes, drink tips and tricks.</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- big menu end -->
                    
          
                </ul>
                <!--
                <ul class="nav navbar-nav hidden-xs hidden-sm">
                   
                    
                    <li class="dropdown search-form-toggle">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>
                        <ul class="dropdown-menu navbar-search-form">
                            <li>
                                <form>
                                    <fieldset>
                                        <div class="form-group nospace">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="search" placeholder="Search" required>
                                                <span class="input-group-btn"><button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button></span>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </li>
                        </ul>
                    </li>
                  
                </ul>
                  -->
            </div>
        </div>
    </header>
