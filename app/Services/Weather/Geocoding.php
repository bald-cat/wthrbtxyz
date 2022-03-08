<?php

namespace App\Services\Weather;

class Geocoding
{

    protected string $city;
    protected int $limit;
    protected array $cityData;
    protected string $link;
    protected string $lat;
    protected string $lon;

    public function __construct($city)
    {
        $this->limit = 1;
        $this->city = $city;
        $this->link = "http://api.openweathermap.org/geo/1.0/direct?q=" . $this->city. "&limit=" . $this->limit . "&appid=" . config('weather.token');
        $this->setCityData()->setLat()->setLon();
    }

    private function setCityData(): static
    {
        $cityData = file_get_contents($this->link);
        $this->cityData = array_merge(...json_decode($cityData, true));
        return $this;
    }

    public function setLat(): static
    {
        $this->lat = $this->cityData['lat'];
        file_put_contents('lat.txt', $this->lat);
        return $this;
    }

    public function setLon(): static
    {
        $this->lon = $this->cityData['lon'];
        file_put_contents('lon.txt', $this->cityData['lon']);
        return $this;
    }

    public function getLat(): string
    {
        return $this->lat;
    }

    public function getLon(): string
    {
        return $this->lon;
    }

}
