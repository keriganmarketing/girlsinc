<?php

namespace GirlsInc\MarcUSA\Geocoder;


final class Point
{
    /**
     * @var float
     */
    private $latitude;
    /**
     * @var float
     */
    private $longitude;
    /**
     * @param float $latitude
     * @param float $longitude
     *
     * @throw \InvalidArgumentException
     */
    public function __construct($latitude, $longitude)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;
    }
    /**
     * @return float
     */
    public function latitude()
    {
        return deg2rad($this->latitude);
    }
    /**
     * @return float
     */
    public function longitude()
    {
        return deg2rad($this->longitude);
    }
}