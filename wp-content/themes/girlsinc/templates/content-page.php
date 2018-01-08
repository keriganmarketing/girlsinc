<div class="page-content row">
    <div class="col-12">
        <?php the_content(); ?>
    </div>
</div>

<?php
//Loop through all page content blocks
if( have_rows('content_blocks') ) :
    while ( have_rows('content_blocks') ) : the_row();
        get_template_part('templates/content_blocks/block', get_row_layout());
    endwhile;
endif;
?>