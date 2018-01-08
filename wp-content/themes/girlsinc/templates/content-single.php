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
            <div class="col-12 text-center">
                <strong class="text-primary"><?= has_tag('Press Release') ? 'Press Release' : 'News' ?></strong>
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="impact-story-share">
                    <p>SHARE <a class="impact-social-icon" href="javascript: void(0);" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=207585636432756&amp;display=popup&amp;name=<?php echo $titleEncoded; ?>&amp;link=<?php echo $linkEncoded; ?>&amp;description=Check+out+this+post&amp;redirect_uri=http://girlsinc.marcusa.co', 'facebook', 'toolbar=0,status=0,width=626,height=450')"><i class="fa fa-facebook-square"></i></a><a class="impact-social-icon" href="javascript:void(0);" onclick="twitterShare()"><i class="fa fa-twitter-square"></i></a></p>
                </div>
            </div>
        </header>
        <div class="row entry-content">
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>
        <footer class="row">
            <!--<div class="col-12 text-center">
                <div class="impact-story-share">
                    <p>SHARE <a class="impact-social-icon" href="javascript: void(0);" onclick="window.open('https://www.facebook.com/dialog/feed?app_id=207585636432756&amp;display=popup&amp;name=<?php echo $titleEncoded; ?>&amp;link=<?php echo $linkEncoded; ?>&amp;description=Check+out+this+post&amp;redirect_uri=http://girlsinc.marcusa.co', 'facebook', 'toolbar=0,status=0,width=626,height=450')"><i class="fa fa-facebook-square"></i></a><a class="impact-social-icon" href="javascript:void(0);" onclick="twitterShare()"><i class="fa fa-twitter-square"></i></a>
                    </p>
                </div>
            </div>-->
            <?php if(get_post_format() === 'video' && $video = get_field('embed_video')) : ?>
                <div class="embed-responsive embed-responsive-16by9">
                    <?= $video ?>
                </div>
            <?php endif; ?>
        </footer>
    </article>
<?php endwhile; ?>
