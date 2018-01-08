<?php use Roots\Sage\Assets; ?>
<footer>
    <div class="container-fluid container-primary">
        <?php if(!is_front_page()) { ?>
        <div class="row prefooter-ctas text-center footer-icons clearfix">
            <div class="d-block col-6">
                <a href="/donate">
                    <img class="mx-auto d-block" src="<?= Assets\asset_path('images/footer-icon-donate.png') ?>">
                    <span class="cta-label">Donate Now</span>
                </a>
            </div>
            <div class="d-block col-6">
                <a href="/take-action/">
                    <img class="mx-auto d-block" src="<?= Assets\asset_path('images/footer-icon-action.png') ?>">
                    <span class="cta-label">Take Action</span>
                </a>
            </div>
        </div>
        <?php } ?>

        <div class="row prefooter-newsletter" id="newsletter-form">
            <div class="col-12">
                <?= do_shortcode('[contact-form-7 id="996" title="Newsletter Sign-up"]') ?>
            </div>
        </div>
    </div>
    <div class="container-fluid container-dark">
        <div class="row footer-sidebar">
            <div class="col-6 col-lg-3">
                <div class="row">
                    <?php dynamic_sidebar('sidebar-footer-init'); ?>
                </div>
            </div>
            <div class="col-6 col-lg-9">
                <div class="row">
                    <?php dynamic_sidebar('sidebar-footer'); ?>
                </div>
            </div>
        </div>
        <div class="row footer-social">
            <div class="col-xl-9 offset-xl-3">
                <span>CONNECT WITH US</span>
                <?= do_shortcode('[social_icons]'); ?>
            </div>
        </div>
        <hr>
        <div class="row footer-copyright">
            <div class="col-">
                <p>&copy;<?= date('Y'); ?> Girls Inc. 120 Wall Street, New York, NY 10005-39021 ∙ <a href="mailto:communications@girlsinc.org">communications@girlsinc.org</a></p>
            </div>
        </div>
    </div>
</footer>
