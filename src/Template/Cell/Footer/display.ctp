<?php use Cake\Core\Configure; ?>
    <div class="footer-v1">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <a href="/"><img id="logo-footer" class="footer-logo" src="/assets/img/maximum-venture-logo-2.png" alt="<?= Configure::read('websiteName') ?> logo"></a>
                        <p><?= Configure::read('websiteName') ?> is news about Canadian Business</p>
                        <p>Find the latest news on trade, media, telecom, small business, personal finance and more.</p>
                    </div><!--/col-md-3-->
                    <!-- End About -->

                    <!-- Latest -->
                   
                    <div class="col-md-3 md-margin-bottom-40">
                        <!--
                        <div class="posts">
                            <div class="headline"><h2>Latest Posts</h2></div>
                            <ul class="list-unstyled latest-list">
                                <li>
                                    <a href="#">Incredible content</a>
                                    <small>May 8, 2014</small>
                                </li>
                                <li>
                                    <a href="#">Best shoots</a>
                                    <small>June 23, 2014</small>
                                </li>
                                <li>
                                    <a href="#">New Terms and Conditions</a>
                                    <small>September 15, 2014</small>
                                </li>
                            </ul>
                        </div>
                        -->
                    </div>
                   
                    <!--/col-md-3-->
                    <!-- End Latest -->

                    <!-- Link List -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><div class="h2style">Links</div></div>
                        <ul class="list-unstyled link-list">
                            <li><a href="/pages/about-us/">About us</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="/pages/legal/">Legal</a><i class="fa fa-angle-right"></i></li>
                           
                        </ul>
                    </div><!--/col-md-3-->
                    <!-- End Link List -->

                    <!-- Address -->
                    <div class="col-md-3 map-img md-margin-bottom-40">
                        <div class="headline"><div class="h2style">Contact Us</div></div>
                        <address class="md-margin-bottom-40">
                            298 Dundas St. W.<br />
                            Toronto, ON <br />
                            Canada<br />
                            <br />
                            Email: <a href="mailto:zhunt@yyztech.ca" class="">zhunt@yyztech.ca</a>
                        </address>
                    </div><!--/col-md-3-->
                    <!-- End Address -->
                </div>
            </div>
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            2015 - <?= date('Y')?> &copy; <a href="http://www.yyzmedia.ca" target="_blank">YYZtech Group Media Ltd.</a>
                           <a href="/pages/legal/">Privacy Policy</a> | <a href="/pages/legal/">Terms of Service</a>
                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="col-md-6">
                        <ul class="footer-socials list-inline">
                            <li>
                                <a href="https://www.facebook.com/<?= Configure::read('websiteFacebook') ?>/"  title="<?= Configure::read('websiteFacebook') ?>" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.twitter.com/<?= Configure::read('websiteTwitter') ?>/" title="@<?= Configure::read('websiteFacebook') ?>" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <!-- End Social Links -->
                </div>
            </div>
        </div><!--/copyright-->
    </div>