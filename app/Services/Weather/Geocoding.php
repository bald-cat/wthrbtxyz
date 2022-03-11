<?php

namespace App\Services\Weather;

use App\Models\City;
use App\Services\Telegram\Message;
use Illuminate\Support\Facades\Log;

class Geocoding
{

    protected string $city;
    protected int $limit;
    protected array $cityData;
    protected string $link;
    protected $lat;
    protected $lon;

    public function __construct($city)
    {
        $this->limit = 1;
        $this->city = $city;
        $this->link = "http://api.openweathermap.org/geo/1.0/direct?q=" . $this->city. "&limit=" . $this->limit . "&appid=" . config('weather.token');

        $this->setCityData()->setLat()->setLon();

        if($this->lon != null) {
            $insertCity = City::query()->firstOrCreate(
                ['name' => $city]
            );
            $insertCity->increment('count');
        }


    }

    private function setCityData(): static
    {
        $cityData = file_get_contents($this->link);
        $this->cityData = array_merge(...json_decode($cityData, true));
        return $this;
    }

    public function setLat(): static
    {
        $this->lat = $this->cityData['lat']  ?? null;
        return $this;
    }

    public function setLon(): static
    {
        $this->lon = $this->cityData['lon'] ?? null;
        return $this;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLon()
    {
        return $this->lon;
    }

}
