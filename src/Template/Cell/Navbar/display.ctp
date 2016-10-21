    <div class="header">
        <div class="container">
            <!-- Logo -->
            <a class="logo" href="/">
                <img src="/assets/img/maximum-venture-logo.png" alt="Maximum Venture logo" class="top_logo" >
            </a>
            <!-- End Logo -->

            <!-- Topbar -->
            <div class="topbar">
               
                <ul class="loginbar pull-right">
                    <!--
                    <li class="hoverSelector">
                        <i class="fa fa-globe"></i>
                        <a>Languages</a>
                        <ul class="languages hoverSelectorBlock">
                            <li class="active">
                                <a href="#">English <i class="fa fa-check"></i></a>
                            </li>
                            <li><a href="#">French</a></li>
                        </ul>
                    </li>
                -->
                    <li class="topbar-devider"></li>
                    <li><a href="/suggest_news">Submit Story</a></li>
                <!-- 
                    <li class="topbar-devider"></li>
                    <li><a href="page_login.html">Login</a></li>
                -->
                </ul>
               
            </div>
            <!-- End Topbar -->

            <!-- Toggle get grouped for better mobile display -->
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!-- End Toggle -->
        </div><!--/end container-->

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
            <div class="container">
                <ul class="nav navbar-nav">

                    <!-- Shortcodes -->
                    <li class="dropdown mega-menu-fullwidth">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="mega-menu-content disable-icons">
                                    <div class="container">
                                        <div class="row equal-height">
                                            <div class="col-md-3 equal-height-in">
                                                <ul class="list-unstyled equal-height-list">
                                                    <li><h3>Categories</h3></li>
                                                    <?php foreach ($categoriesList as $slug => $name): ?>
                                                        <li><a href="/category/<?= $slug ?>/"><i class="fa fa-tags"></i> <?= $name ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 equal-height-in">
                                                
                                            </div>
                                            <div class="col-md-3 equal-height-in">
                                               
                                            </div>
                                            <div class="col-md-3 equal-height-in">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- End Shortcodes -->


                    <!-- Search Block -->
                    <li>
                        <i class="search fa fa-search search-btn"></i>
                        <div class="search-open">
                            <form action="/searches/text_search/" method="get">
                            <div class="input-group animated fadeInDown">
                                <input type="text" class="form-control" name="search" placeholder="Search">
                                <span class="input-group-btn">
                                    <button class="btn-u" type="submit">Go</button>
                                </span>
                            </div>
                            </form>
                        </div>
                    </li>
                    <!-- End Search Block -->

                </ul>
            </div><!--/end container-->
        </div><!--/navbar-collapse-->
    </div>
