<?php

namespace App\Services\Weather;

class SevenDaysWeather
{

    protected string $lang = 'ru';
    protected string $units = 'metric';
    protected $lat;
    protected $lon;
    protected $link;
    public $weather;
    private array $digest;
    private string $text = '';

    public function __construct($city)
    {
        $this->geo = new Geocoding($city);
        $this->setLon($this->geo->getLon())
            ->setLat($this->geo->getLat());

        if ($this->lon != null) {
            $this->setLink()
                ->setWeather()
                ->setDigest();
        }
    }

    public function setWeather(): static
    {
        $weather = file_get_contents($this->link);
        $weather = json_decode($weather);
        $this->weather = $weather->daily;
        return $this;
    }

    public function getWeather()
    {
        return $this->weather;
    }

    private function setLink(): static
    {
        $this->link =  "http://api.openweathermap.org/data/2.5/onecall?lat=$this->lat&lon=$this->lon&appid=" . config('weather.token')."&lang=$this->lang&units=$this->units";
        return $this;
    }

    public function setLat($lat): static
    {
        $this->lat = $lat;
        return $this;
    }

    public function setLon($lon): static
    {
        $this->lon = $lon;
        return $this;
    }

    protected function setDigest(): static
    {
        foreach ($this->weather as $day) {
            $this->digest[] = (new DayWeatherShaper($day))->getText();
        }
        return $this;
    }


    public function getDigest(): string
    {
        foreach ($this->digest as $day) {
            $this->text .= $day;
        }

        return $this->text;
    }




}
