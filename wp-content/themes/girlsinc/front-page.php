<?php get_template_part('templates/homepage', 'header'); ?>

<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<?php //get_template_part('templates/homepage', 'footer'); ?>