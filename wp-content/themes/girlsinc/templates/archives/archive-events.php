<div class="events-archive row row-eq-heigh">
    <?php while (have_posts()) : the_post(); ?>

        <article <?php post_class("col-xs-6 col-md-3") ?>>

            <?php
            $isTbd = get_field('event_tbd');
            $linkFormat = $isTbd ? '<div class="%3$s">%1$s</div>' : '<a href="%2$s" class="%3$s">%1$s</a>';
            ?>

            <div class="event-image">
                <?php
                if(has_post_thumbnail()){
                    printf($linkFormat,
                        get_the_post_thumbnail(null, 'large', ['class'=>'img-fluid']),
                        get_permalink(),
                        'luncheon-thumbnail'
                    );
                }
                /*else{
                    if($startField = get_field('start_date')){
                        $startDate = strtotime($startField);
                        $date = new DateTimeImmutable($startDate);
                        $start = $date->format('F<\b\r>d, Y');
                    }
                    else{
                        $start = 'TBA';
                    }
                    $fallback = <<<EOT
                    <span class="text-fallback event-label">Save the Date</span>
                    <span class="text-fallback start-date">{$start}</span>
EOT;

                    printf($linkFormat, $fallback, get_permalink(), 'luncheon-no-thumbnail');
                }*/
                ?>
            </div>

            <div class="event-copy">
                <?php printf($linkFormat, get_the_title(), get_permalink(), 'luncheon-link'); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>