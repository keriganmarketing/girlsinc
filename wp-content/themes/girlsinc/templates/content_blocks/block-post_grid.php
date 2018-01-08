<?php
$row = get_row(true);
$q = new WP_Query([
    'posts_per_page' => 3,
    'post__in' => $row['posts'],
    'order_by' => 'post__in',
    'post_type' => 'any'
]);
?>
<div id="homepage-footer">
    <div class="news-grid col-12">
        <div class="row">
            <?php $i=0; while($q->have_posts()) : $q->the_post(); ?>
                <?php
                $hasSpotlight = get_field('spotlight');
                $type = get_post_type();
                if($type === 'post'){
                    $type = get_the_category()[0]->category_nicename;
                }
                if ($type === 'impact_stories') {
                    $label = get_the_terms(get_the_ID(), 'impact_label');
                    $type = ($label)? $label[0]->name :'IMPACT STORY';
                }
                ?>
                <div class="news-article<?= $i % 2 ? ' d-flex flex-column-reverse' : '' ?> col-lg-4 col-xl-4 col-xs-12 col-sm-12<?= ($hasSpotlight ? ' spotlight' : '') ?>">
                    <div class="article-block image-block">
                        <a href="<?php the_permalink(); ?>">
                            <?php if(has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('news-thumbnail-size', ['class'=>'img-fluid']); ?>
                            <?php else : ?>
                                <img class="img-fluid" src="http://placehold.it/640x480" />
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="article-block body-block">
                        <div class="row" style="height: 100%;">
                            <a class="link-overlay" href="<?php the_permalink(); ?>">&nbsp;</a>
                            <div class="col-12 my-auto">
                                <h5><?= ($hasSpotlight ? 'Spotlight' : $type) ?></h5>
                                <p><?php the_title() ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            <?php $i++; endwhile; ?>
        </div>
    </div>
    <?php if( $row['read_more_text']) { ?>
    <div class="col-12 text-center">
        <a href="<?= $row['read_more_url'] ?>" id="news-load-more"><?= $row['read_more_text'] ?></a>
    </div>
    <?php } ?>
</div>
