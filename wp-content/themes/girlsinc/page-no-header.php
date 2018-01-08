<?php
  /**
  * Template Name: No Header Template
  */
?>

<div class="page-no-header">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('templates/content', 'page'); ?>
  <?php endwhile; ?>
</div>
