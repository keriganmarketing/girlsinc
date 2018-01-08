<?php $slides = get_field('homepage_slider'); ?>

<?php if(count($slides)) : ?>
    <div class="homepage-gallery-hold">
        <div class="homepage-text col-xs-12 col-lg-9"><?= get_field('homepage_banner_text'); ?></div>
        <div class="homepage-gallery-wrapper row">
            <?php foreach($slides as $slide) : ?>
                <div class="page-header" style="height: 573px; background-image: url(<?= $slide['slide_image'] ?>);">

                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>