<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;
use Roots\Sage\Titles;
use GirlsInc\MarcUSA\BrandWidget;
use GirlsInc\MarcUSA\ContactWidget;
use GirlsInc\MarcUSA\GoogleMaps;

/**
 * Theme setup
 */
function setup()
{
    // Enable features from Soil when plugin is activated
    // https://roots.io/plugins/soil/
    add_theme_support('soil-clean-up');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-relative-urls');

    // Make theme available for translation
    // Community translations can be found at https://github.com/roots/sage-translations
    load_theme_textdomain('sage', get_template_directory() . '/lang');

    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    add_theme_support('title-tag');

    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    // Enable post thumbnails
    // http://codex.wordpress.org/Post_Thumbnails
    // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    // http://codex.wordpress.org/Function_Reference/add_image_size
    add_theme_support('post-thumbnails');

    // Enable post formats
    // http://codex.wordpress.org/Post_Formats
    add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    // Use main stylesheet for visual editor
    // To add custom styles edit /assets/styles/layouts/_tinymce.scss
    add_editor_style(Assets\asset_path('styles/main.css'));

    // Allow pages to have excerpts
    add_post_type_support('page', 'excerpt');

    add_image_size( 'news-thumbnail-size', 480, 480, true );

}

add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Register sidebars
 */
function widgets_init()
{
    register_sidebar([
        'name' => __('News', 'sage'),
        'id' => 'sidebar-news',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>'
    ]);
    register_sidebar([
        'name' => __('Footer 2', 'sage'),
        'id' => 'sidebar-footer',
        'before_widget' => '<section class="col-12 col-md-4 widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>'
    ]);
    register_sidebar([
        'name' => __('Footer 1', 'sage'),
        'id' => 'sidebar-footer-init',
        'before_widget' => '<section class="col-12 widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>'
    ]);

    register_widget(BrandWidget::class);
    register_widget(ContactWidget::class);
}

add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

/**
 * Theme assets
 */
function assets()
{
    wp_enqueue_style('sage/css', Assets\asset_path('styles/main.css'), false, null);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('marcusa-verge', Assets\asset_path('scripts/verge.min.js'), ['jquery'], null, true);
    //wp_enqueue_script('marcusa-chart', Assets\asset_path('scripts/chart.js'), ['jquery'], null, true);
    wp_enqueue_script('sage/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);

    wp_localize_script('sage/js', 'Marc', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce( "girls-inc-nonce" )
    ]);
}

function admin_assets()
{
    wp_enqueue_style('marcusa_admin', Assets\asset_path('styles/admin.css'));
    wp_enqueue_script('marcusa_admin', Assets\asset_path('scripts/admin.js'));
    wp_localize_script('marcusa_admin', 'Marc', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_assets');

/**
 * Theme shortcodes
 */
function marcusa_shortcode_yoast_icons()
{
    $social = get_option('wpseo_social');
    ob_start();
    ?>
    <ul class="social-icons">
        <?php foreach (marcusa_generate_social_icons($social) as $icon => $url) : ?>
            <li class="social-link">
                <a href="<?= $url ?>" target="_blank"><i class="fa fa-<?= $icon ?>"></i></a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
    return ob_get_clean();
}

function marcusa_generate_social_icons(array $social)
{
    yield 'facebook-square' => $social['facebook_site'];
    yield 'twitter-square' => 'https://twitter.com/' . $social['twitter_site'];
    yield 'instagram' => $social['instagram_url'];
    yield 'linkedin-square' => $social['linkedin_url'];
    yield 'youtube-play' => $social['youtube_url'];
}

function marcusa_shortcode_highlight_text($atts = null, $content)
{
    $id = get_the_ID();
    return Titles\marcusa_wrap_title_segment($content, $content, $id);
}

function marcusa_shortcode_column($atts = null, $content)
{
    return sprintf('<div class="col">%s</div>', do_shortcode($content));
}

function marcusa_shortcode_template($atts)
{
    $a = shortcode_atts([
        'name' => false
    ], $atts);

    $output = '';

    if ($a['name']) {
        ob_start();
        get_template_part('templates/shortcodes/tpl', $a['name']);
        $output = ob_get_clean();
    }

    return $output;
}

function marcusa_shortcode_icon($atts, $content = '')
{
    $a = shortcode_atts([
        'name' => false,
        'url' => false,
        'target' => '_blank'
    ], $atts);

    $output = '';
    if ($a['name']) {
        $icon = '<i class="fa fa-%3$s"></i>%4$s';
        $fmt = $a['url'] ? '<a class="marcusa-icon" href="%s" target="%s">' . $icon . '</a>' : '<span class="marcusa-icon">' . $icon . '</span>';
        $output .= sprintf($fmt, $a['url'], $a['target'], $a['name'], $content);
    }
    return $output;
}

add_shortcode('social_icons', __NAMESPACE__ . '\\marcusa_shortcode_yoast_icons');
add_shortcode('highlight', __NAMESPACE__ . '\\marcusa_shortcode_highlight_text');
add_shortcode('column', __NAMESPACE__ . '\\marcusa_shortcode_column');
add_shortcode('template', __NAMESPACE__ . '\\marcusa_shortcode_template');
add_shortcode('icon', __NAMESPACE__ . '\\marcusa_shortcode_icon');

/**
 * Query Modifications
 */
function marcusa_pre_get_posts($query)
{
    if ($query->get('post_type') === 'leadership') {
        $query->set('posts_per_page', -1);
    }
}

add_action('pre_get_posts', __NAMESPACE__ . '\\marcusa_pre_get_posts');

/**
 * Custom Field Modifications
 */
add_filter('acf/update_value/name=spotlight', __NAMESPACE__ . '\\marcusa_single_use_custom_field', 10, 3);
function marcusa_single_use_custom_field($value, $post_id, $field)
{
    if ($value === "1") {

        //Delete the field from all other posts using it
        $posts = get_posts([
            'numberposts' => -1,
            'post_type' => get_post_type($post_id),
            'meta_key' => 'spotlight',
            'meta_value' => '1',
            'fields' => 'ids'
        ]);
        foreach ($posts as $post) {
            delete_field('spotlight', $post);
        }

    } else {
        $value = null; //Delete the field instead of allowing a '0' value (simplifies the query)
    }
    return $value;
}

/**
 * TinyMCE
 *
 * TODO: Expand functionality to allow for more seamless row/column layouts in the Wordpress Editor (Low Priority)
 */
add_action('init', __NAMESPACE__ . '\\marcusa_init');
function marcusa_init()
{
    add_filter('mce_external_plugins', __NAMESPACE__ . '\\marcusa_add_custom_tinymce');
    add_filter('mce_buttons', __NAMESPACE__ . '\\marcusa_register_custom_tinymce');
}

function marcusa_add_custom_tinymce($plugin_array)
{
    $plugin_array['girlsinc'] = Assets\asset_path('/scripts/tinymce.js');
    return $plugin_array;
}

function marcusa_register_custom_tinymce($buttons)
{
    array_push($buttons, 'highlight');
    return $buttons;
}

/**
 * Custom Columns
 */
add_filter('manage_impact_stories_posts_columns', __NAMESPACE__ . '\\marcusa_add_custom_posts_columns');
add_filter('manage_post_posts_columns', __NAMESPACE__ . '\\marcusa_add_custom_posts_columns');
add_filter('manage_blog_posts_columns', __NAMESPACE__ . '\\marcusa_add_custom_posts_columns');
add_action('manage_impact_stories_posts_custom_column', __NAMESPACE__ . '\\marcusa_add_custom_posts_columns_content', 10, 2);
add_action('manage_post_posts_custom_column', __NAMESPACE__ . '\\marcusa_add_custom_posts_columns_content', 10, 2);
add_action('manage_blog_posts_custom_column', __NAMESPACE__ . '\\marcusa_add_custom_posts_columns_content', 10, 2);

function marcusa_add_custom_posts_columns($defaults)
{
    $defaults['spotlight'] = 'Featured Story';
    return $defaults;
}

function marcusa_add_custom_posts_columns_content($column, $post)
{
    if ($column == 'spotlight') {
        $field = get_field('spotlight', $post);
        $enabled = $field === true ? 'filled' : 'empty';
        printf('<a class="update-spotlight-id icon-%2$s" href="#" data-post-id="%d"><span class="dashicons dashicons-star-%s"></span></a>', $post, $enabled);
    }
}

/**
 * Plugin fixes
 */
function marcusa_wpmdb_mu_path($url, $path)
{
    if ($path === 'wp-migrate-db') {
        $url = WPMU_PLUGIN_URL . "/{$path}";
    }
    return $url;
}

add_filter('plugins_url', __NAMESPACE__ . '\\marcusa_wpmdb_mu_path', 10, 2); //Fix Migrate DB paths as MU Plugin

/**
 * Core Fixes
 */
function meta_query_join_bugfix($join, $wp_query){
    if(!isset($wp_query->query['orderby']) || !is_home()){
        return $join;
    }

    $params = $wp_query->query['orderby'];
    if(is_string($params)){
        $params = explode(' ', $wp_query->query['orderby']);
    }
    if(in_array('has_spotlight', $params)) {
        //This corrects an SQL error that's native to this current version of Wordpress
        global $wpdb;
        $joins = explode(' LEFT JOIN ', $join);
        $joins[2] = str_replace(')', " AND {$wpdb->postmeta}.meta_key = 'spotlight')", $joins[2]);

        return implode(' LEFT JOIN ', $joins);
    }
    return $join;
}
add_filter('posts_join', __NAMESPACE__ . '\\meta_query_join_bugfix', 10, 2);


//Add Option To General For Location
add_filter('admin_init', __NAMESPACE__ . '\\general_girls_location');
function general_girls_location(){
    register_setting('general', 'girls_location', 'esc_attr');
    add_settings_field('girls_location', '<label for="girls_location">' . __('Chapter Location', 'girlsinc') . '</label>', __NAMESPACE__ . '\\girls_location', 'general');
}
function girls_location(){
    $value = get_option('girls_location');
    $maps = new GoogleMaps();
    $locations = $maps->loadMarkers();
    echo '<select id="girls_location" name="girls_location">';

    foreach($locations as $key => $info){

        echo '<option value="'. $info['address']['data']['lat'] .',' . $info['address']['data']['lng'] . ',' . $info['ID'] . '" ';
        $id = $info['address']['data']['lat'] .',' . $info['address']['data']['lng'] . ',' . $info['ID'];
        if($id == $value){
            echo 'selected';
        }

        echo '>' .$info['name']. '</option>';
    }

    echo '</select>';
}