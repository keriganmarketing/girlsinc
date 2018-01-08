<?php
$otherPage = isset($_GET['otherNews']) ? $_GET['otherNews'] : 1;
$pressPage = isset($_GET['pressRelease']) ? $_GET['pressRelease'] : 1;

$news = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 4,
    'orderby' => 'has_spotlight post_date',
    'meta_query' => [
        'relation' => 'OR',
        'has_spotlight' => [
            'key' => 'spotlight',
            'value' => '1'
        ],
        'standard' => [
            'key' => 'spotlight',
            'compare' => 'NOT EXISTS'
        ]
    ],
    'tax_query' => [
        [
            'taxonomy' => 'post_tag',
            'field'    => 'name',
            'terms'    => 'Featured News'
        ]
    ]
]);
$featuredIds = wp_list_pluck($news->posts, 'ID');
$other = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'paged' => $otherPage,
    'post__not_in' => $featuredIds,
    'tax_query' => [
        [
            'taxonomy' => 'post_tag',
            'field'    => 'name',
            'terms'    => ['Press Release'],
            'operator' => 'NOT IN'
        ]
    ]
]);
$pressReleases = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'paged' => $pressPage,
    'post__not_in' => $featuredIds,
    'tax_query' => [
        [
            'taxonomy' => 'post_tag',
            'field'    => 'name',
            'terms'    => 'Press Release'
        ]
    ]
]);
?>

<div id="news-articles" class="row">
    <?php for ($i=0;$news->have_posts();$i++) : $news->the_post();
        $background = has_post_thumbnail() ? get_the_post_thumbnail_url() : false;
        $isFull = get_field('layout') === 'full';
        if($fullImage = get_field('full_width_image')){
            $background = $fullImage;
        }
    ?>
        <?php if($isFull) : ?>
            <article <?php post_class('col-12 featured-background'); ?> style="background-image: <?= $background ? "url({$background})" : 'none' ?>">
                <div class="entry-summary row">
                    <div class="col-xs-12 col-lg-6 text-wrapping">
                        <strong class="text-primary">Featured News</strong>
                        <h1 class="entry-title">
                            <?php the_title(); ?>
                        </h1>
                        <a href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                </div>
            </article>
        <?php else: ?>
            <article <?php post_class('col-12'); ?>>
                <div class="row<?= $i % 2 ? ' flex-row-reverse' : '' ?>">
                <?php get_template_part('templates/content'); ?>
                </div>
            </article>
        <?php endif; ?>
    <?php endfor; ?>
</div>

<?php if($other->have_posts()) : ?>
<div id="other-news" class="row">
    <div class="col-12" id="other-news-inner">
        <div class="news-inner-content other-news-inner-content">
            <strong class="text-primary">News</strong>
            <?php while ($other->have_posts()) : $other->the_post(); ?>
                <?php get_template_part('templates/content', 'news'); ?>
            <?php endwhile; ?>

            <div class="pagination other-pagination">
                <?= paginate_links([
                    'prev_next' => false,
                    'format'  => '?otherNews=%#%',
                    'current' => $otherPage,
                    'total'   => $other->max_num_pages,
                    'add_args' => ['pressRelease' => $pressPage]
                ]); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div id="press-releases" class="row">
    <div class="col-md-8" id="press-releases-inner">
        <div class="news-inner-content press-releases-inner-content">
            <strong class="text-primary">Press Release</strong>
            <?php while ($pressReleases->have_posts()) : $pressReleases->the_post(); ?>
                <?php get_template_part('templates/content', 'news'); ?>
            <?php endwhile; ?>

            <div class="pagination press-pagination">
                <?= paginate_links([
                    'prev_next' => false,
                    'format'  => '?pressRelease=%#%',
                    'current' => $pressPage,
                    'total'   => $pressReleases->max_num_pages,
                    'add_args' => ['otherNews' => $otherPage]]);
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <?php dynamic_sidebar('sidebar-news'); ?>
    </div>
</div>