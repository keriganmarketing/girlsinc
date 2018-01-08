<?php

namespace Roots\Sage\AJAX;

use GirlsInc\MarcUSA\GoogleMaps;

add_action('wp_ajax_update_spotlight', __NAMESPACE__ . '\\marcusa_ajax_update_spotlight');
function marcusa_ajax_update_spotlight()
{
    if (isset($_POST['ID'])) {
        $currentField = get_field('spotlight', $_POST['ID']);
        if ($currentField === true) {
            delete_field('spotlight', $_POST['ID']);
        } else {
            update_field('spotlight', '1', $_POST['ID']);
        }
    }
    wp_die(1);
}

/*add_action('wp_ajax_newsletter_signup', __NAMESPACE__ . '\\marcusa_newsletter_signup');
add_action('wp_ajax_nopriv_newsletter_signup', __NAMESPACE__ . '\\marcusa_newsletter_signup');
function marcusa_newsletter_signup()
{
    check_ajax_referer('girls-inc-nonce', 'nonce');

    global $wpdb;

    $wpdb->hide_errors();
    $result = $wpdb->insert('wp_newsletter_signups', [
        'email' => $_POST['email']
    ]);

    $response = 'Thank you for signing up!';
    if ($result === false) { //An error happened
        if (substr($wpdb->last_error, 0, 9) === 'Duplicate') { //Duplicate entry
            $response = 'That email already exists in our system.';
        }
    }
    wp_die($response);
}*/

add_action('wp_ajax_search_zip', __NAMESPACE__ . '\\marcusa_search_zip');
add_action('wp_ajax_nopriv_search_zip', __NAMESPACE__ . '\\marcusa_search_zip');
function marcusa_search_zip()
{
    check_ajax_referer('girls-inc-nonce', 'nonce');

    $map = new GoogleMaps;
    wp_die(json_encode([
        'geometry' => $map->getZipLatLng($_POST['zip'])
    ]));
}

add_action('wp_ajax_search_id', __NAMESPACE__.'\\marcusa_search_id');
add_action('wp_ajax_nopriv_search_id', __NAMESPACE__.'\\marcusa_search_id');

function marcusa_search_id(){
    check_ajax_referer('girls-inc-nonce', 'nonce');

    $map = new GoogleMaps;
    wp_die(json_encode([
        'geometry' => $map->getZipLatLngID($_POST['id'])
    ]));
}