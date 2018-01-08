<?php

namespace Roots\Sage\Extras;

//Load extra scripts
require_once 'src/NavWalker.php';
require_once 'src/BrandWidget.php';
require_once 'src/ContactWidget.php';
require_once 'src/GoogleMaps.php';
require_once 'src/GoogleMapsLocation.php';
require_once 'src/Geocoder/Geocoder.php';
require_once 'src/Geocoder/Address.php';
require_once 'src/Geocoder/Point.php';
require_once 'src/Geocoder/Distance.php';

use Roots\Sage\Setup;
use GirlsInc\MarcUSA\GoogleMaps;
use GeoIp2\Exception\AddressNotFoundException;

/**
 * Add <body> classes
 */
function body_class($classes)
{
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        $name = basename(get_permalink());
        if (!in_array($name, $classes)) {
            $classes[] = $name;
        }
    }

    return $classes;
}

add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more()
{
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}

add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Map Hooks
 */

function marcusa_after_setup_theme()
{
    if (is_page('find-girls-inc')) {
        $map = new GoogleMaps;
        $center = [
            37.09024, //US Center Lat
            -95.712891 //US Center Lng
        ];
        if(isset($_GET['zip']) && $_GET['zip']){
            $center = $map->getZipLatLng($_GET['zip']);
        }
        else if(isset($_GET['state']) && $_GET['state']){
            $center = $map->getStateLatLng($_GET['state']);
        }

        $markers = $map->loadMarkers();

        add_action('wp_enqueue_scripts', function () use ($map, $center, &$markers) {
            wp_localize_script('sage/js', 'Geo', [
                'center' => $center,
                'zip' => isset($_GET['zip']) ? $_GET['zip'] : false,
                'state' => isset($_GET['state']) ? $_GET['state'] : false,
                'markers' => $markers
            ]);
        }, 110);
    }
}

add_action('wp', __NAMESPACE__ . '\\marcusa_after_setup_theme');

function marcusa_render_google_map(GoogleMaps $map)
{
    $map->render();
}

add_action('marcusa_init_google_maps', __NAMESPACE__ . '\\marcusa_render_google_map');

/**
 * Helpers
 */
function get_current_page()
{
    global $wp;
    return home_url($wp->request);
}

/**
 * Misc. Plugins
 */

//ACF oEmbed
add_filter('oembed_dataparse', function ($return, $data) {
    if ($data->provider_name == 'YouTube') {
        $data->html = str_replace('feature=oembed', 'feature=oembed&rel=0', $data->html);
        $return = $data->html;
    }
    return $return;
}, 10, 2);

//ACF Post Type Args
add_filter('acf_field_posttype_select/get_post_types_args', function ($args) {
    return ['publicly_queryable' => true];
});

//BrowserDetect
add_filter('marcusa_browser_default_version_compare', function(){
    return '<=';
});
add_filter('marcusa_incompatible_template', function () {
    return locate_template('ie9.php');
});
//add_filter('marcusa_browser_is_incompatible', '__return_true'); //Uncomment this to force the page to display

/**
 * Custom Taxonomy Management
 */
function marcusa_add_address_columns($columns)
{
    $columns['latitude'] = 'Latitude';
    $columns['longitude'] = 'Longitude';
    return $columns;
}

add_filter('manage_edit-address_columns', __NAMESPACE__ . '\\marcusa_add_address_columns');
add_filter('manage_edit-zip_code_columns', __NAMESPACE__ . '\\marcusa_add_address_columns');

function marcusa_manage_address_columns($content, $column_name, $term_id)
{
    switch ($column_name) {
        case 'latitude':
            $content = get_term_meta($term_id, 'latitude', true);
            break;
        case 'longitude':
            $content = get_term_meta($term_id, 'longitude', true);
            break;
    }
    return $content;
}

add_filter('manage_address_custom_column', __NAMESPACE__ . '\\marcusa_manage_address_columns', 10, 3);
add_filter('manage_zip_code_custom_column', __NAMESPACE__ . '\\marcusa_manage_address_columns', 10, 3);

function marcusa_edit_address_fields($term)
{
    $lat = get_term_meta($term->term_id, 'latitude', true);
    $lng = get_term_meta($term->term_id, 'longitude', true);
    ?>
    <tr class="form-field">
        <th scope="row">
            <label for="marcusa_latitude">Latitude</label>
        </th>
        <td>
            <input id="marcusa_latitude" name="marcusa_latitude" type="text" value="<?= $lat; ?>"/>
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row">
            <label for="marcusa_longitude">Longitude</label>
        </th>
        <td>
            <input id="marcusa_longitude" name="marcusa_longitude" type="text" value="<?= $lng; ?>"/>
        </td>
    </tr>
    <?php
}

add_action('address_edit_form_fields', __NAMESPACE__ . '\\marcusa_edit_address_fields');
add_action('zip_code_edit_form_fields', __NAMESPACE__ . '\\marcusa_edit_address_fields');

function save_address_custom_meta($term_id)
{
    if (isset($_POST['marcusa_latitude'])) {
        update_term_meta($term_id, 'latitude', $_POST['marcusa_latitude']);
    }
    if (isset($_POST['marcusa_longitude'])) {
        update_term_meta($term_id, 'longitude', $_POST['marcusa_longitude']);
    }
}

add_action('edited_address', __NAMESPACE__ . '\\save_address_custom_meta');
add_action('create_address', __NAMESPACE__ . '\\save_address_custom_meta');
add_action('edited_zip_code', __NAMESPACE__ . '\\save_address_custom_meta');
add_action('create_zip_code', __NAMESPACE__ . '\\save_address_custom_meta');

function add_address_filter_management($postType)
{
    if ($postType === 'locations') {
        $info_taxonomy = get_taxonomy('address');
        wp_dropdown_categories(array(
            'show_option_all' => __("Show All {$info_taxonomy->label}"),
            'taxonomy' => 'address',
            'name' => 'address',
            'orderby' => 'name',
            'selected' => isset($_GET['address']) ? $_GET['address'] : '',
            'show_count' => false,
            'hide_empty' => true,
            'hierarchical' => true,
            'depth' => 2
        ));
    }
}

function process_address_filter_management($query)
{
    if(is_admin() && function_exists("get_current_screen")){
        $post_type = 'locations';
        $taxonomy = 'address';
        $screen = get_current_screen();

        if ($screen->id === 'edit-locations' && $query->get('post_type') === $post_type && $query->get($taxonomy) != 0) {
            $term = get_term_by('id', $query->get($taxonomy), $taxonomy);
            $query->set($taxonomy, $term->slug);
        }
    }
}

add_action('restrict_manage_posts', __NAMESPACE__ . '\\add_address_filter_management');
add_filter('parse_query', __NAMESPACE__ . '\\process_address_filter_management');

http://player.pbs.org/viralplayer/3003805062/
wp_embed_register_handler( 'pbs', '#http://player\.pbs\.org/viralplayer/([\d]+)#i', function ( $matches, $attr, $url, $rawattr ) {

    $url = 'http://player.pbs.org/viralplayer/%d/';
    $embed = sprintf('<div class="pbs-embed"><iframe src="'.$url.'" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" seamless allowfullscreen></iframe></div>', esc_attr($matches[1]));

    return apply_filters( 'embed_pbs', $embed, $matches, $attr, $url, $rawattr );
} );
