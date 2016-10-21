<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Configure;
use Cake\I18n\Time;

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title><?= $this->fetch('title') ?></title>
    <?php 
    if ( $this->fetch('meta_description') ) {
        echo $this->Html->meta('description', trim($this->fetch('meta_description')) );
    }

    if ( $this->fetch('canonical')) {
        echo $this->Html->meta('canonical', $this->fetch('canonical'), ['rel'=>'canonical', 'type'=>null, 'title'=>null, 'inline' => false]);
    }

    if ( $this->fetch('meta_index') ) {
        echo $this->Html->meta('robots', $this->fetch('meta_index'));
    } else {
        echo $this->Html->meta('robots', 'index, follow');
    }    

    if ( $this->fetch('social_image_url') ) {
        echo "<link rel=\"image_src\" type=\"image/jpeg\" href=\"{$this->fetch('social_image_url')}\" />";
    }
    ?>
    <meta name="content-language" content="en">

    <?php if( $this->fetch('social_name') ): ?>
        <?= $this->Html->meta('', Configure::read('websiteName') , ['name' => 'og:site_name'] ) ?>
        <?= $this->Html->meta('', 'summary_large_image' , ['name' => 'twitter:card'] ) ?>
        <?= $this->Html->meta('', '@'.Configure::read('websiteTwitter') , ['name' => 'twitter:author'] ) ?>
        <?= $this->Html->meta('', '@'.Configure::read('websiteTwitter') , ['name' => 'twitter:creator'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_name')) , ['name' => 'twitter:title'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_name')) , ['name' => 'og:title'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_image_url')) , ['name' => 'twitter:image'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_image_url')) , ['name' => 'og:image'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('canonical')) , ['name' => 'og:url'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_description')) , ['name' => 'twitter:description'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_description')) , ['name' => 'og:description'] ) ?>
        <?= $this->Html->meta('', trim($this->fetch('social_image_url')) , ['name' => 'twitter:image'] ) ?>
        <?php if ( $this->fetch('ogType') ){
        echo $this->Html->meta('', trim($this->fetch('ogType')) , ['name' => 'og:type'] );
        }?> 

  <?php

    $articleDate = Time::parse( $this->fetch('articleDate') ); 
    $json = [
      '@context' => 'http://schema.org/',
      'name' => $this->fetch('social_name'),
      '@type' => "Article",
      "author" => Configure::read('websiteName') . ' staff',
      "ArticleSection" => $this->fetch('articleCategory'),
      "datePublished" => $articleDate->i18nFormat('yyyy-MM-dd'),
      "headline" => $this->fetch('articleSubhead'),
      "Publisher" => Configure::read('websiteName'),
      "image" => "http://www.maximumventure.ca/assets/img/maximum-venture-logo.png",
      "url" => $this->fetch('canonical')
    ];

    if ( $this->fetch('social_image_url') ) {
       $json['image'] = $this->fetch('social_image_url');
    }
    echo '<script type="application/ld+json">'. json_encode($json) .'</script>';
    
  ?>      


    <?php endif; ?>


    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   


    <!-- Favicon -->
    <link rel="shortcut icon" href="/img/favicon.ico">

    <link rel="apple-touch-icon" sizes="57x57" href="/img/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon-16x16.png">
    <link rel="manifest" href="/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">



    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <?php if ( $this->fetch('criticalCss') ) {
        echo $this->element('critical_css', ['cache' => ['key' => 'critical_css' ] ] );
    } ?> 

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- CSS Header and Footer -->
    <!-- link rel="stylesheet" href="assets/css/headers/header-default-centered.css" -->
    <link rel="stylesheet" href="/assets/css/headers/header-default.css">
    <link rel="stylesheet" href="/assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/assets/plugins/animate.css">
    <link rel="stylesheet" href="/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style ... for mason theme -->
    <link rel="stylesheet" href="/assets/css/pages/blog_masonry_3col.css">

    <link rel="stylesheet" href="/assets/css/pages/blog.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="/assets/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="/assets/css/theme-colors/mv-red.css" id="style_color">
    <link rel="stylesheet" href="/assets/css/theme-skins/dark.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/assets/css/custom.css">



    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-1890732-39', 'auto');
      ga('send', 'pageview');

    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
   

</head>
<body>

<div class="wrapper">
    <!--=== Header ===-->
    <?php  
    //$navbarCell = $this->cell('Navbar'); 
    //echo $navbarCell;

    echo $this->cache(function () {
        echo $this->cell('Navbar');
    }, ['key' => 'main_navbar']);
    ?>
    <!--=== End Header ===-->

    <?php // $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

    <!-- content area ends -->


    <!--=== Footer Version 1 ===-->
    <?php  
    //$footerCell = $this->cell('Footer'); 
    //echo $footerCell;
    echo $this->cache(function () {
        echo $this->cell('Footer');
    }, ['key' => 'main_footer']);    
    ?>

    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<!--
<script type="text/javascript" src="/assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery/jquery-migrate.min.js"></script>
-->
<script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>

<script   src="https://code.jquery.com/jquery-migrate-1.4.0.min.js"   integrity="sha256-nxdiQ4FdTm28eUNNQIJz5JodTMCF5/l32g5LwfUwZUo="   crossorigin="anonymous"></script>


<script type="text/javascript" src="/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="/assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="/assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery.parallax.js"></script>
<script type="text/javascript" src="/assets/plugins/masonry/jquery.masonry.min.js"></script>

<!-- JS Customization -->
<script type="text/javascript" src="/assets/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="/assets/js/app.js"></script>
<script type="text/javascript" src="/assets/js/pages/blog-masonry.js"></script>

<?= $this->fetch('script') ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        //StyleSwitcher.initStyleSwitcher();
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->
<script id="dsq-count-scr" src="//<?= Configure::read('disqusUrl') ?>.disqus.com/count.js" async></script>
</body>
</html>