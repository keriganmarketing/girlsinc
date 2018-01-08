<?php

namespace GirlsInc\MarcUSA\Geocoder;

class Distance
{
    const EARTH_RADIUS = 6371000;

    private $a;
    private $b;

    public function __construct(Point $a, Point $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function meters($precision = 0)
    {
        $deltaLatitude = $this->b->latitude() - $this->a->latitude();
        $deltaLongitude = $this->b->longitude() - $this->a->longitude();
        $angle = asin(
                sqrt(
                    pow(sin($deltaLatitude * 0.5), 2)
                    + cos($this->a->latitude()) * cos($this->b->latitude())
                    * pow(sin($deltaLongitude * 0.5), 2)
                )
            ) * 2;
        return round(self::EARTH_RADIUS * $angle, $precision);
    }

    public function kilometers($precision = 0)
    {
        return round($this->meters() * 0.001, $precision);
    }

    public function miles($precision = 0)
    {
        return round($this->meters() * 0.000621371, $precision);
    }

    public function centimeters($precision = 0)
    {
        return round($this->meters() * 100, $precision);
    }

    public function yards($precision = 0)
    {
        return round($this->meters() * 1.09361, $precision);
    }

    public function feet($precision = 0)
    {
        return round($this->meters() * 3.28083, $precision);
    }
}