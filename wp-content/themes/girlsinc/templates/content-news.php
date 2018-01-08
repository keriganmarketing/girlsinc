<article <?php post_class('row'); ?>>
    <div class="col-sm-12 col-md-8 my-auto">
        <div class="entry-summary">
            <h5 class="entry-title no-uppercase">
                <?php the_title(); ?>
            </h5>
            <a href="<?php the_permalink(); ?>">Read More</a>
        </div>
    </div>
    <?php if(has_post_thumbnail()) : ?>
    <div class="col-sm-12 col-md-4">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail', ['class'=>'img-fluid']); ?></a>
    </div>
    <?php endif; ?>
</article>
<hr>
