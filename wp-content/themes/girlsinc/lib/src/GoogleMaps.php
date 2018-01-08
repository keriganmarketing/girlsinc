<?php

namespace GirlsInc\MarcUSA;

use GirlsInc\MarcUSA\Geocoder\Distance;
use GirlsInc\MarcUSA\Geocoder\Geocoder;
use GeoIp2\Database\Reader;
use GirlsInc\MarcUSA\Geocoder\Point;

class GoogleMaps
{
    const GOOGLE_MAPS_KEY = '';

    public function render()
    {
        if (!wp_script_is('google-maps', 'enqueued')) {
            wp_enqueue_script('google-maps', $this->getScriptUrl());
        }
    }

    public function loadMarkers()
    {
        global $wpdb;
        $sql = "
            SELECT p.ID, 
              p.post_title, 
              address.name AS address, 
              zip.name AS zip, 
              tm_lat.meta_value AS latitude, 
              tm_lng.meta_value AS longitude, 
              pm_phone.meta_value AS phone, 
              pm_fax.meta_value AS fax, 
              pm_director.meta_value AS director, 
              pm_leadertitle.meta_value AS leadertitle,
              pm_email.meta_value AS email, 
              pm_website.meta_value AS website
            FROM {$wpdb->posts} p
            INNER JOIN (
                SELECT tr.object_id AS ID, GROUP_CONCAT(t.name ORDER BY t.term_id DESC) AS name, MAX(t.term_id) AS streetID
                FROM {$wpdb->term_relationships} tr
                INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'address'
                INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id
                GROUP BY ID
            ) address ON p.ID = address.ID
            INNER JOIN (
                SELECT tr.object_id AS ID, t.name AS name
                FROM {$wpdb->term_relationships} tr
                INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'zip_code'
                INNER JOIN {$wpdb->terms} t ON t.term_id = tt.term_id
                GROUP BY ID
            ) zip ON p.ID = zip.ID
            LEFT JOIN {$wpdb->termmeta} tm_lat ON address.streetID = tm_lat.term_id AND tm_lat.meta_key = 'latitude'
            LEFT JOIN {$wpdb->termmeta} tm_lng ON address.streetID = tm_lng.term_id AND tm_lng.meta_key = 'longitude'
            LEFT JOIN {$wpdb->postmeta} pm_phone ON pm_phone.post_id = p.ID AND pm_phone.meta_key = 'telephone'
            LEFT JOIN {$wpdb->postmeta} pm_fax ON pm_fax.post_id = p.ID AND pm_fax.meta_key = 'fax'
            LEFT JOIN {$wpdb->postmeta} pm_director ON pm_director.post_id = p.ID AND pm_director.meta_key = 'executive_director'
            LEFT JOIN {$wpdb->postmeta} pm_leadertitle ON pm_leadertitle.post_id = p.ID AND pm_leadertitle.meta_key = 'affiliate_leader_title'
            LEFT JOIN {$wpdb->postmeta} pm_email ON pm_email.post_id = p.ID AND pm_email.meta_key = 'email'
            LEFT JOIN {$wpdb->postmeta} pm_website ON pm_website.post_id = p.ID AND pm_website.meta_key = 'website'
            WHERE p.post_type = 'locations' AND p.post_status = 'publish'
        "; // (╯°□°）╯︵ ┻━┻

        $results = $wpdb->get_results($sql);
        return iterator_to_array($this->generateMarkers($results));
    }

    public static function getRequestLatLng($ip = null)
    {
        $reader = new Reader(__DIR__ . '/../data/GeoLite2-City.mmdb');
        return $reader->city($ip ?: $_SERVER['REMOTE_ADDR']);
    }

    public function getZipLatLng($zip)
    {
        $country = preg_match('/[\d]{5}/', $zip) ? 'United States' : 'Canada';
        return $this->getLatLng(
            (string)$zip,
            'zip_code',
            "geozip_{$zip}",
            "{$zip} {$country}"
        );
    }

    public function getStateLatLng($state)
    {
        return $this->getLatLng(
            $state,
            'address',
            "geostate_{$state}",
            "{$state}"
        );
    }

    private function getLatLng($term, $taxonomy, $cacheKey, $geoKey, $expire = WEEK_IN_SECONDS)
    {
        if ($fromTerm = $this->getLatLngFromTerm($term, $taxonomy)) {
            return $fromTerm;
        }
        if ($fromCache = get_transient($cacheKey)) {
            return $fromCache;
        }
        if ($fromGeo = $this->getLatLngFromGeocoder($geoKey)) {
            set_transient($cacheKey, $fromGeo, $expire);
            return $fromGeo;
        }
        return false; //Bad request
    }

    private function getLatLngFromTerm($name, $taxonomy)
    {
        if ($term = term_exists($name, $taxonomy)) {
            $lat = (float)get_term_meta($term['term_id'], 'latitude', true);
            $lng = (float)get_term_meta($term['term_id'], 'longitude', true);
            return [$lat, $lng];
        }
        return false;
    }

    private function getLatLngFromGeocoder($address)
    {
        $geocoder = Geocoder::make();
        $results = $geocoder->geocodeString($address);

        return $results->status === 'OK' ? [
            $results->results[0]->geometry->location->lat,
            $results->results[0]->geometry->location->lng
        ] : false;
    }

    private function generateMarkers($data)
    {
        foreach ($data as $row) {
            yield (new GoogleMapsLocation($row))->toArray();
        }
    }

    private function getScriptUrl()
    {
        $key = $this->getApiKey();
        return "https://maps.googleapis.com/maps/api/js?key={$key}&libraries=geometry&callback=mapOnReady";
    }

    private function getApiKey()
    {
        return env('GOOGLE_MAPS_KEY') ?: self::GOOGLE_MAPS_KEY;
    }
}
