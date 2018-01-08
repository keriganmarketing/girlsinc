<?php
$background = has_post_thumbnail() ? get_the_post_thumbnail_url() : false;
$imgPos = get_field('hero_img_position');
$color = get_field('heading_content_color') ?: 'inherit';
?>

<style type="text/css">
    @media all and (max-width: 991px) {
        .page-header.row {
            background-position: <?= $imgPos ?: 'center' ?> center !important;
        }
    }
</style>
<div class="page-header row" style="background-image:<?= "url({$background})" ?: 'none' ?>;">
    <div class="col-xs-12 col-lg-8 header-content" style="color: <?= $color ?>">
        <?php if ($headingContent = get_field('heading_content')) : ?>
            <?= $headingContent ?>
        <?php else : ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
        <?php endif; ?>
    </div>
</div>
