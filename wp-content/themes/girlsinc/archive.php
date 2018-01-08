<?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'sage'); ?>
    </div>
    <?php get_search_form(); ?>
<?php endif; ?>

<?php get_template_part('templates/archives/archive', get_post_type()); ?>