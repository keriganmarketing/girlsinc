<?php
    $positions = get_terms('positions');
    $archiveLink = home_url('/about-us/leadership/');
?>

<div class="position-filter row">
    <div class="col-12">
        <ul class="filter-list">
        <?php foreach($positions as $i=> $position) : ?>
            <li class="filter-option">
                <a href="<?= '#';//get_term_link($position) ?>" data-filter=".positions-<?= $position->slug ?>" class="<?= $i ?: 'active-filter' ?>">
                    <?= $position->name ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="leadership-archive row">
<?php while (have_posts()) : the_post(); ?>
    <?php if($post->post_name === 'judy-vredenburgh-leadership') : ?>
    <article <?php post_class("col-12 loading") ?>>
        <div class="row flex-md-row-reverse">
            <div class="col-md-4">
                <?php the_post_thumbnail('full', ['class'=>'img-fluid']); ?>
            </div>
            <div class="col-md-8 text-wrapping" style="padding-top: 0;">
                <?php the_content(); ?>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-9 text-wrapping" style="padding-top: 0;">
                <h3>The management team leads a staff of <span class="text-primary">50 people.</span></h3>
            </div>
        </div>
    </article>
    <?php else : ?>
    <article <?php post_class("col-xs-6 col-md-4 col-lg-15 loading") ?>>
        <?php if(has_post_thumbnail()) : ?>
        <div class="leadership-image">
            <?php the_post_thumbnail('medium', ['class'=>'img-fluid']); ?>
        </div>
        <?php endif; ?>
        <div class="leadership-copy">
            <h6 class="text-primary"><?php the_title(); ?></h6>
            <?php the_content(); ?>
        </div>
    </article>
    <?php endif; ?>
<?php endwhile; ?>
</div>
