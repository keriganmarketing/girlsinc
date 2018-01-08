<?php
$row = get_row(true);

extract($row);

$relation = isset($learn_more[0]) ? $learn_more[0] : false;
$excerpt = $custom_excerpt;

if ($relation && !$image) { //Fallback to featured image
    $image = get_post_thumbnail_id($relation);
}
if ($relation && !$excerpt) { //Fallback to Post / Page Excerpt
    $excerpt = get_the_excerpt($relation);
}

$image = wp_get_attachment_image_src($image, 'large');
$image_layout = $image ? $image_layout : 'None';

$imageClasses = $excerptClasses = ['col-xs-12 '];

if (in_array($image_layout, ['Left', 'Right'])) {
    $imageClasses[] = $excerptClasses[] = 'col-md-6 col-lg-6';
    if ($image_layout === 'Right') {
        $imageClasses[] = 'flex-last';
        $excerptClasses[] = 'flex-first';
    }
} elseif ($excerpt_layout !== 'Full Width') {
    $excerptClasses[] = 'col-md-6 col-lg-6';
    if ($excerpt_layout === 'Right') {
        $excerptClasses[] = 'offset-md-6';
    }
}

?>

<div class="content-block content-block-excerpt <?php if($image_layout == 'Background') { ?>full-bg-image<?php } ?> <?php if($row['excerpt_custom-class']) {?><?= implode(' ', $row['excerpt_custom-class']) ?><?php } ?> <?= $relation ? ' content-block-excerpt-' . $relation->ID : '' ?> row"
     style="background-image: <?= $image_layout === 'Background' ? "url({$image[0]})" : 'none' ?>">
    <?php if ($image_layout !== 'Background' && $image_layout !== 'None') : ?>
        <div class="<?= implode(' ', $imageClasses) ?> image-column">
            <img class="img-fluid" src="<?= $image[0] ?>">
        </div>
    <?php endif; ?>

    <?php if ($excerpt) : ?>
        <div class="<?= implode(' ', $excerptClasses) ?> my-auto excerpt-column" style="color: <?= $excerpt_color ?>">
            <?php if ($relation) : ?>
                <h3><?= get_the_title($relation) ?></h3>
                <p><?= $excerpt ?></p>
                <a class="learn-more" href="<?= get_permalink($relation) ?>">Learn More</a>
            <?php else : ?>
                <p><?= $excerpt ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
