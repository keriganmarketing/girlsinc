<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
<body <?php body_class('ie9-incompatible'); ?>>
<div class="wrap container-fluid main-wrap" role="document">
    <header>
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
                    <img src="<?= \Roots\Sage\Assets\asset_path('images/logo-inverse.png'); ?>" alt="Highmark">
                </a>
            </div>
        </div>
    </header>
    <main class="main">
        <div id="incompatible" class="container">
            <div class="content-inner">
                <div class="row">
                    <div class="message text-center">
                        <h1>SORRY,</h1>
                        <h3>but you are using a browser that is not supported.</h3>
                        <small>To properly view this page please use your mobile device or one of the following browsers:</small>
                    </div>
                </div>
                <div class="row">
                    <div class="browser-box">
                        <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank"><img src="<?= \Roots\Sage\Assets\asset_path('images/firefox.png'); ?>"></a>
                        <p>Mozilla Firefox</p>
                    </div>
                    <div class="browser-box">
                        <a href="https://www.google.com/chrome/browser/desktop/index.html" target="_blank"><img src="<?= \Roots\Sage\Assets\asset_path('images/chrome.png'); ?>"></a>
                        <p>Google Chrome</p>
                    </div>
                    <div class="browser-box">
                        <a href="https://support.microsoft.com/en-us/help/17621/internet-explorer-downloads" target="_blank"><img src="<?= \Roots\Sage\Assets\asset_path('images/edge.png'); ?>"></a>
                        <p>Microsoft Edge</p>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- /.main -->
</div><!-- /.wrap -->
<?php wp_footer(); ?>
</body>
</html>
