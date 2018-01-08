<?php

namespace GirlsInc\MarcUSA\Geocoder;

use GuzzleHttp\Client;
use RuntimeException;

/**
 * Class Geocoder
 * @package MarcUSA\Firehouse
 */
class Geocoder
{
    /**
     * @var Client
     */
    private $guzzle;

    /**
     * Geocoder constructor.
     * @param Client $guzzle
     */
    public function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    /**
     * @return static
     */
    public static function make()
    {
        return new static(new Client);
    }

    /**
     * @param Address $address
     * @return array|mixed|object
     */
    public function geocode(Address $address)
    {
        $addressParam = $this->sanitize((string)$address);
        return $this->geocodeString($addressParam);
    }

    public function geocodeString($address){
        return $this->request('http://maps.googleapis.com/maps/api/geocode/json',
            ['address' => urlencode($address)]);
    }

    /**
     * @param Address $address
     * @return Address
     */
    public function pinpoint(Address $address)
    {
        $geo = $this->geocode($address);
        if ($geo->status !== 'OK') {
            $msg = sprintf("Could not pinpoint the address '%s'. Google Maps returned with a status '%'",
                (string)$address, $geo->status);
            throw new RuntimeException($msg);
        }
        return $address->fromGeoComponents($geo->results[0]);
    }

    private function sanitize($address)
    {
        $noPo = preg_replace('/((P(OST)?.?\s*(O(FF(ICE)?)?)?.?\s+(B(IN|OX))?)|B(IN|OX))\s*([\d]+)/i', '', $address);
        $clean = preg_replace('/^[^a-z\d]+/i', '', $noPo);
        return trim($clean, " \t\n\r\0\x0B,");
    }

    /**
     * @param $url
     * @param array $params
     * @return array|mixed|object
     */
    private function request($url, array $params = [])
    {
        $response = $this->guzzle->request('GET', $url, [
            'query' => $params
        ]);
        $result = (string)$response->getBody();
        return json_decode($result);
    }
}