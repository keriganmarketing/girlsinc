<?php
use Roots\Sage\Assets;
use GirlsInc\MarcUSA\NavWalker;

?>

<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '207585636432756',
            cookie     : true,
            xfbml      : true,
            version    : 'v2.8'
        });
        FB.AppEvents.logPageView();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div id="mobile-navigation" class="hidden-xl-up">
    <div id="mobile-navigation-inner">
        <div class="pull-left z-position-up">
            <a data-toggle="collapse" href="#primary-navigation" aria-expanded="false" aria-controls="primary-navigation">Menu</a>
        </div>
        <div class="mobile-brand">
            <a class="brand" href="<?= esc_url(home_url('/')); ?>">
                <img src="<?= Assets\asset_path('images/logo-inverse.png'); ?>" class="show-on-header">
                <img src="<?= Assets\asset_path('images/logo-primary.png'); ?>" class="show-on-no-header">
            </a>
        </div>
        <div class="pull-right z-position-up">
            <a href="/donate" class="btn btn-primary">Donate</a>
        </div>
    </div>
</div>
<header class="nav-fixed-left collapse" id="primary-navigation">
    <div class="nav-scroller">
        <div id="primary-navigation-inner">
            <div class="brand-container">
                <a data-toggle="collapse" href="#primary-navigation" aria-expanded="true" aria-controls="primary-navigation" class="hidden-xl-up">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <a class="brand" href="<?= esc_url(home_url('/')); ?>">
                    <img src="<?= Assets\asset_path('images/logo-primary.png') ?>">
                </a>
                <p class="tagline hidden-lg-down"><?php bloginfo('description'); ?></p>
                <a href="#" class="btn btn-primary hidden-xl-up">Donate</a>
            </div>
            <nav class="nav-primary">
                <?php
                if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new NavWalker]);
                endif;
                ?>
            </nav>
        </div>
        <div id="secondary-navigation-inner">
            <a href="/donate" class="btn btn-primary hidden-lg-down">Donate</a>
            <div class="header-social">
                <span>Connect With Us</span>
                <?= do_shortcode('[social_icons]'); ?>
            </div>
        </div>
    </div>
</header>
