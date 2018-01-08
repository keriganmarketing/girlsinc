
<?php if(has_post_thumbnail()) : ?>
<div class="col-sm-12 col-md-6 my-auto">
    <div class="entry-summary text-wrapping">
        <strong class="text-primary">Featured News</strong>
        <h2 class="entry-title no-uppercase">
            <?php the_title(); ?>
        </h2>
        <a href="<?php the_permalink(); ?>">Read More</a>
    </div>
</div>
<div class="col-sm-12 col-md-6 news-image my-auto">
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large', ['class'=>'img-fluid']); ?></a>
</div>
<?php else : ?>
<div class="col-12 text-center">
    <div class="entry-summary">
        <strong class="text-primary">News</strong>
        <h2 class="entry-title no-uppercase">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <a href="<?php the_permalink(); ?>">Read More</a>
    </div>
</div>
<?php endif; ?>
