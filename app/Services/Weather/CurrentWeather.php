<?php

namespace App\Services\Weather;

use DateTime;
use DateTimeZone;

class CurrentWeather
{

    protected string $lang = 'ru';
    protected string $units = 'metric';
    protected $lat;
    protected $lon;
    protected $link;
    protected $weather;
    protected $temp;
    protected $description;
    protected $geo;
    protected $icon;
    protected $feelsLike;
    protected $sunset;
    protected $sunrise;
    protected $windSpeed;
    protected $windDeg;

    public function __construct($city)
    {
        $this->geo = new Geocoding($city);
        $this->setLon($this->geo->getLon())
            ->setLat($this->geo->getLat());

        if($this->lon != null){
            $this->setLink()
                ->setWeather()
                ->setTemp()
                ->setDescription()
                ->setFeelsLike()
                ->setIcon()
                ->setSunset()
                ->setSunrise()
                ->setWindDeg()
                ->setWindSpeed();
        } else {
            $this->weather = null;
        }

    }

    public function setWeather(): static
    {
        $weather = file_get_contents($this->link);
        $this->weather = json_decode($weather);
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

    public function setLink(): static
    {
        $this->link =  "http://api.openweathermap.org/data/2.5/weather?lat=$this->lat&lon=$this->lon&appid=" . config('weather.token')."&lang=$this->lang&units=$this->units";
        return $this;
    }

    public function getWeather()
    {
        return $this->weather;
    }

    public function setTemp(): static
    {
        $this->temp = floor($this->weather->main->temp);
        return $this;
    }

    public function getTemp()
    {
        return $this->temp;
    }

    public function setSunset(): static
    {
        $this->sunset = $this->weather->sys->sunset;
        return $this;
    }

    public function setSunrise(): static
    {
        $this->sunrise = $this->weather->sys->sunrise;
        return $this;
    }

    public function getSunset(): string
    {
        $sunset = new DateTime();
        $sunset->setTimestamp($this->sunset);
        $sunset->setTimezone(new DateTimeZone('Europe/Kiev'));
        $time = $sunset->format('H:i');
        return "\xF0\x9F\x8C\x87 <i>Время заката:</i> $time (Киев)";
    }

    public function getSunrise(): string
    {
        $sunrise = new DateTime();
        $sunrise->setTimestamp($this->sunrise);
        $sunrise->setTimezone(new DateTimeZone('Europe/Kiev'));
        $time = $sunrise->format('H:i');
        return "\xF0\x9F\x8C\x85 <i>Время рассвета:</i> $time (Киев)";
    }

    public function setWindSpeed()
    {
        $this->windSpeed = $this->weather->wind->speed;
    }

    public function getWindSpeed(): string
    {
        return "\xF0\x9F\x8D\x83<i>Скорость ветра:</i> $this->windSpeed м/с";
    }

    public function setWindDeg(): static
    {
        $this->windDeg = $this->weather->wind->deg;
        return $this;
    }

    public function getWindDeg(): string
    {
        $windEmojis = [
            "north west" => "\xE2\x86\x96",
            "north east" => "\xE2\x86\x97",
            "south east" => "\xE2\x86\x98",
            "south west" => "\xE2\x86\x99",
        ];

        $windDeg = '';
        if ($this->windDeg == 360) {
            $windDeg = "\xE2\xAC\x87 <i>Направление ветра:</i> Северный ($this->windDeg &#176;)";
        } elseif ($this->windDeg == 180) {
            $windDeg = "\xE2\xAC\x86 <i>Направление ветра:</i> Южный ($this->windDeg &#176;)";
        } elseif ($this->windDeg == 90) {
            $windDeg = "\xE2\xAC\x85 <i>Направление ветра:</i> Восточный ($this->windDeg &#176;)";
        } elseif ($this->windDeg == 270) {
            $windDeg = "\xE2\x9E\xA1 <i>Направление ветра:</i> Западный ($this->windDeg &#176;)";
        } elseif ($this->windDeg > 270 && $this->windDeg < 360) {
            $windDeg = "{$windEmojis["south east"]}<i>Направление ветра:</i> Северо-Западный ($this->windDeg &#176;)";
        } elseif ($this->windDeg > 180 && $this->windDeg < 270) {
            $windDeg = "{$windEmojis["north east"]}<i>Направление ветра:</i> Юго-Западный ($this->windDeg &#176;)";
        } elseif ($this->windDeg > 90 && $this->windDeg < 180) {
            $windDeg = "{$windEmojis["north west"]}<i>Направление ветра:</i> Юго-Восточный ($this->windDeg &#176;)";
        } elseif ($this->windDeg < 90) {
            $windDeg = "{$windEmojis["south west"]}<i>Направление ветра:</i> Северо-Восточный ($this->windDeg &#176;)";
        }

        return $windDeg;

    }

    public function setDescription(): static
    {
        $this->description = $this->weather->weather[0]->description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setFeelsLike(): static
    {
        $this->feelsLike = floor($this->weather->main->feels_like);
        return $this;
    }

    public function getFeelsLike(): string
    {
        return "\xE2\x81\x89 Ощущается как <b>$this->feelsLike</b> &#8451;";
    }

    public function setIcon()
    {
        $this->icon = $this->weather->weather[0]->icon;
        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getText(): string
    {
        return "<b>$this->temp</b> &#8451; $this->description";
    }

}
