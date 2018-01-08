<?php

namespace GirlsInc\MarcUSA\Geocoder;

/**
 * Class Address
 * @package MarcUSA\Firehouse
 */
final class Address
{
    /**
     * @var string
     */
    private $address;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $state;
    /**
     * @var string
     */
    private $zip;
    /**
     * @var string
     */
    private $country;
    /**
     * @var float
     */
    private $lat;
    /**
     * @var float
     */
    private $lng;

    public static $stateRepo = [
        'AL'=>'Alabama',
        'AK'=>'Alaska',
        'AZ'=>'Arizona',
        'AR'=>'Arkansas',
        'CA'=>'California',
        'CO'=>'Colorado',
        'CT'=>'Connecticut',
        'DE'=>'Delaware',
        'FL'=>'Florida',
        'GA'=>'Georgia',
        'HI'=>'Hawaii',
        'ID'=>'Idaho',
        'IL'=>'Illinois',
        'IN'=>'Indiana',
        'IA'=>'Iowa',
        'KS'=>'Kansas',
        'KY'=>'Kentucky',
        'LA'=>'Louisiana',
        'ME'=>'Maine',
        'MD'=>'Maryland',
        'MA'=>'Massachusetts',
        'MI'=>'Michigan',
        'MN'=>'Minnesota',
        'MS'=>'Mississippi',
        'MO'=>'Missouri',
        'MT'=>'Montana',
        'NE'=>'Nebraska',
        'NV'=>'Nevada',
        'NH'=>'New Hampshire',
        'NJ'=>'New Jersey',
        'NM'=>'New Mexico',
        'NY'=>'New York',
        'NC'=>'North Carolina',
        'ND'=>'North Dakota',
        'OH'=>'Ohio',
        'OK'=>'Oklahoma',
        'OR'=>'Oregon',
        'PA'=>'Pennsylvania',
        'RI'=>'Rhode Island',
        'SC'=>'South Carolina',
        'SD'=>'South Dakota',
        'TN'=>'Tennessee',
        'TX'=>'Texas',
        'UT'=>'Utah',
        'VT'=>'Vermont',
        'VA'=>'Virginia',
        'WA'=>'Washington',
        'WV'=>'West Virginia',
        'WI'=>'Wisconsin',
        'WY'=>'Wyoming',
    ];

    /**
     * Address constructor.
     * @param $address
     * @param $city
     * @param $state
     * @param $zip
     * @param string $country
     * @param float|null $lat
     * @param float|null $lng
     */
    public function __construct($address, $city, $state, $zip, $country = 'United States', $lat = null, $lng = null)
    {
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->lat = $lat;
        $this->lng = $lng;
    }

    /**
     * @param $components
     * @return $this
     */
    public function fromGeoComponents($components)
    {
        $streetNumber = '';
        $route = '';
        $this->lat = $components->geometry->location->lat;
        $this->lng = $components->geometry->location->lng;

        foreach ($components->address_components as $component) {
            if (self::exists(['subpremise', 'street_number'], $component->types)) {
                $streetNumber = $component->long_name;
                continue;
            }
            if (self::exists(['route'], $component->types)) {
                $route = $component->long_name;
                continue;
            }
            if (self::exists(['locality'], $component->types)) {
                $this->city = $component->long_name;
                continue;
            }
            if (self::exists(['administrative_area_level_1'], $component->types)) {
                $this->state = $component->long_name;
                continue;
            }
            if (self::exists(['postal_code'], $component->types)) {
                $this->zip = $component->long_name;
                continue;
            }
            if (self::exists(['country'], $component->types)) {
                $this->country = $component->long_name;
                continue;
            }
        }
        if ($streetNumber && $route) {
            $this->address = "{$streetNumber} {$route}";
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip' => $this->zip,
            'country' => $this->country,
            'lat' => $this->lat,
            'lng' => $this->lng
        ];
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function get($property)
    {
        return $this->{$property};
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function set($property, $value)
    {
        return $this->{$property} = $value;
    }

    public static function make(array $data)
    {
        $country = isset($data['country']) ? $data['country'] : null;
        $lat = isset($data['lat']) ? $data['lat'] : null;
        $lng = isset($data['lng']) ? $data['lng'] : null;
        return new static($data['address'], $data['city'], $data['state'], $data['zip'], $country, $lat, $lng);
    }

    /**
     * @param array $needle
     * @param array $haystack
     * @return bool
     */
    private static function exists(array $needle, array $haystack)
    {
        return (bool)count(array_intersect($haystack, $needle));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->address},\n{$this->city} {$this->state}, {$this->zip}";
    }

}