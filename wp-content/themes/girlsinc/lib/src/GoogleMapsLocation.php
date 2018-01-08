<?php

namespace GirlsInc\MarcUSA;

use stdClass;
use GirlsInc\MarcUSA\Geocoder\Address;

final class GoogleMapsLocation
{
    private $row;
    private $address;

    public function __construct(stdClass $row)
    {
        $this->row = $row;
        $this->address = $this->toAddress($row);
    }
    public function toArray(){
        return [
            'ID' => $this->row->ID,
            'name' => $this->row->post_title,
            'address' => [
                'human' => (string)$this->address,
                'data' => $this->address->toArray()
            ],
            'phone' => $this->row->phone,
            'fax' => $this->row->fax,
            'director' => $this->row->director,
            'email' => $this->row->email,
            'website' => $this->row->website
        ];
    }
    public static function toAddress(stdClass $row){
        list($street, $city, $state, $country) = explode(',', $row->address);
        return new Address($street, $city, $state, $row->zip, $country, $row->latitude, $row->longitude);
    }
}