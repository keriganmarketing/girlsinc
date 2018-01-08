<?php
$hasSpotlight = false;
$spotlight = get_posts([
    'post_type' => 'impact_stories',
    'meta_key' => 'spotlight',
    'posts_per_page' => 1
]);
$q = new WP_Query([
    'posts_per_page' => count($spotlight) ? 2 : 3
]);

$news = get_page_by_title('News');

if(count($spotlight)){
    $hasSpotlight = true;
    array_splice($q->posts, 2, 0, $spotlight); // Make sure the Spotlight is third
}

?>
<div id="homepage-footer">
    <div class="news-grid col-12">
        <div class="row">
            <?php $i = 0; foreach($q->posts as $i=>$post) : setup_postdata($post); ?>

                <div class="news-article<?= $i % 2 ? ' d-flex flex-column-reverse' : '' ?> col-lg-4 col-xl-4 col-xs-12 col-sm-12<?= ($hasSpotlight && $i === 2 ? ' spotlight' : '') ?>">
                    <div class="article-block image-block">
                        <?php if(has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', ['class'=>'img-fluid']); ?></a>
                        <?php else : ?>
                            <img class="img-fluid" src="http://placehold.it/640x480" />
                        <?php endif; ?>
                    </div>
                    <a href="<?php the_permalink(); ?>">
                        <div class="article-block body-block">
                            <h5><?= ($i === 2 ? 'Spotlight' : 'News') ?></h5>
                            <p><?php the_title() ?></p>
                        </div>
                    </a>
                    <div class="clearfix"></div>
                </div>
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
    <div class="col-12 text-center">
        <a href="<?= get_permalink($news) ?>" id="news-load-more">See More</a>
    </div>
</div>
