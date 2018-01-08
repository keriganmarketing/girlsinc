<?php
$q = new WP_Query([
    'post_type' => 'impact_stories',
    'orderby' => 'meta_key',
    'order' => 'DESC',
    'meta_query' => [
        [
            'key' => 'spotlight',
            'value' => '1'
        ]
    ]
]);


$q2 = new WP_Query([
    'post_type' => 'impact_stories',
    'orderby' => 'meta_key',
    'order' => 'DESC',
    'meta_query' => [
        [
            'key' => 'spotlight',
            'compare' => 'NOT EXISTS'
        ]
    ]
]);

$q2->posts = array_merge($q->posts, $q2->posts);
$q2->post_count = $q2->post_count + $q->post_count;

for ($i = 0; $q2->have_posts(); $i++) : $q2->the_post();
    $background = has_post_thumbnail() ? get_the_post_thumbnail_url() : false;
    $isFull = get_field('layout') === 'full';
    if($fullImage = get_field('full_width_image')){
        $background = $fullImage;
    }
    $label = get_the_terms(get_the_ID(), 'impact_label');

    ?>
    <article <?php post_class('row' . ($i ? '' : ' spotlight')) ?>>
        <div class="col-12">
            <?php if (!$i) : ?>
                <div class="featured-background row"
                     style="background-image: <?= $background ? "url({$background})" : 'none' ?>">
                    <div class="col-xs-12 col-lg-6 impact-overview">
                        <strong class="text-primary impact-type"><?= ($label) ? $label[0]->name : 'Spotlight'; ?></strong>
                        <h3><?php the_title() ?></h3>
                        <a href="<?php the_permalink() ?>">Read Her Story</a>
                    </div>
                </div>
            <?php elseif($isFull) : ?>
                <div class="featured-background row no-column-gutters<?= $i % 2 ? '' : ' flex-row-reverse' ?>"
                     style="background-image: <?= $background ? "url({$background})" : 'none' ?>">
                    <div class="col-xs-12 col-md-6 offset-md-6 my-auto impact-overview">
                        <strong class="text-primary impact-type"><?= ($label) ? $label[0]->name : 'Impact Story'; ?></strong>
                        <h4 class="no-uppercase"><?php the_title() ?></h4>
                        <a href="<?php the_permalink() ?>">Read More</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row no-column-gutters<?= $i % 2 ? '' : ' flex-row-reverse' ?>">
                    <div class="col-xs-12 col-md-6 impact-image">
                        <?php the_post_thumbnail('full', ['class' => 'img-fluid']) ?>
                    </div>
                    <div class="col-xs-12 col-md-6 my-auto impact-overview">
                        <strong class="text-primary impact-type"><?= ($label) ? $label[0]->name : 'Impact Story'; ?></strong>
                        <h4 class="no-uppercase"><?php the_title() ?></h4>
                        <a href="<?php the_permalink() ?>">Read More</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </article>
    <?php
endfor;
