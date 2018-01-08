<?php
//NOTE: Wordpress is weird. In order for setup_postdata to work, this HAS to be named $post
$post = get_page_by_path('about-us/leadership');

//Archive Page Content
?>
<?php setup_postdata($post); ?>
    <?php get_template_part('templates/page', 'header'); ?>
    <?php get_template_part('templates/content', 'page'); ?>
<?php wp_reset_postdata(); ?>

<?php
//Archive content
get_template_part('templates/archives/archive', 'leadership');
?>
