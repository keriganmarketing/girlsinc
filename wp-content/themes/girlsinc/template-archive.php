<?php
/**
 * Template Name: Archive Page
 */

$archive = get_field('page_archive_type');

//Page Content
?>
<?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<?php
//Archive content

//This modifies the default query. It's not the most performant, but it allows us to do what we need
query_posts(['post_type'=>$archive]);
get_template_part('templates/archives/archive', $archive);
?>
