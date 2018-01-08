<?php while (have_posts()) : the_post(); ?>

    <?php
    $titleEncoded = urlencode(get_the_title());
    $linkEncoded = urlencode(get_the_permalink());
    ?>

    <script>
        u = 'https://twitter.com/intent/tweet?url=' + "<?php echo $linkEncoded; ?>" + '&text=' + "<?php echo $titleEncoded; ?>";

        function twitterShare() {
            window.open(u, 'twitter', 'toolbar=0,status=0,width=626,height=236');
        }
    </script>
    <article <?php post_class(); ?>>
        <header class="row">
            <div class="col-12">
                <?php if ($headingContent = get_field('heading_content')) : ?>
                    <?= $headingContent ?>
                <?php else : ?>
                <h1 class="entry-title text-center"><?php the_title(); ?></h1>
                <?php endif; ?>
            </div>
            <div class="col-12 text-center">
                <div class="impact-story-share">
                    <p>SHARE <a class="impact-social-icon" href="javascript: void(0);" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=207585636432756&amp;display=popup&amp;name=<?php echo $titleEncoded; ?>&amp;link=<?php echo $linkEncoded; ?>&amp;description=Check+out+this+post&amp;redirect_uri=https://girlsinc.marcusa.co', 'facebook', 'toolbar=0,status=0,width=626,height=450')"><i class="fa fa-facebook-square"></i></a><a class="impact-social-icon" href="javascript:void(0);" onclick="twitterShare()"><i class="fa fa-twitter-square"></i></a></p>
                </div>
            </div>
        </header>
        <div class="row entry-content">
            <?php the_content(); ?>
        </div>
        <?php
        //Loop through all page content blocks
        if( have_rows('content_blocks') ) :
            while ( have_rows('content_blocks') ) : the_row();
                get_template_part('templates/content_blocks/block', get_row_layout());
            endwhile;
        endif;
        ?>
    </article>
<?php endwhile; ?>
