<?php

namespace App\Services\Weather;

use DateTime;
use DateTimeZone;

class DayWeatherShaper
{

    private $dailyWeather;
    private $day;
    private array $temp;
    private $description;
    private $sunrise;
    private $sunset;
    private $windSpeed;
    private $windDeg;
    private $feelsLike;
    private $text;
    private $cels = "&#8451;";

    const CELSIUS = "&#8451;";

    public function __construct($dailyWeather)
    {
        $this->dailyWeather = $dailyWeather;
        $this->setTemp()
            ->setDay()
            ->setDesccription()
            ->setFeelsLike()
            ->setSunrise()
            ->setSunset()
            ->setWindDeg()
            ->setWindSpeed()
            ->setText();
    }

    public function setDay()
    {
        $sunset = new DateTime();
        $sunset->setTimestamp($this->dailyWeather->dt);
        $sunset->setTimezone(new DateTimeZone('Europe/Kiev'));
        $time = $sunset->format('d.m.y');
        $this->day = $time;
        return $this;
    }

    public function setTemp(): static
    {
        $this->temp = [
            'max' => ceil($this->dailyWeather->temp->max),
            'min' => ceil($this->dailyWeather->temp->min),
            'morning' => ceil($this->dailyWeather->temp->morn),
            'day' => ceil($this->dailyWeather->temp->day),
            'evening' => ceil($this->dailyWeather->temp->eve),
            'night' => ceil($this->dailyWeather->temp->night),
        ];
        return $this;
    }

    public function setDesccription()
    {
        $this->description = $this->dailyWeather->weather[0]->description;
        return $this;
    }

    public function setSunrise()
    {
        $sunset = new DateTime();
        $sunset->setTimestamp($this->dailyWeather->sunrise);
        $sunset->setTimezone(new DateTimeZone('Europe/Kiev'));
        $time = $sunset->format('H:i');
        $this->sunrise = $time;
        return $this;
    }

    public function setSunset()
    {
        $sunset = new DateTime();
        $sunset->setTimestamp($this->dailyWeather->sunset);
        $sunset->setTimezone(new DateTimeZone('Europe/Kiev'));
        $time = $sunset->format('H:i');
        $this->sunset = $time;
        return $this;
    }

    public function setWindSpeed()
    {
        $this->windSpeed = $this->dailyWeather->wind_speed;
        return $this;
    }

    public function setWindDeg()
    {
        $this->windDeg = $this->dailyWeather->wind_deg;
        return $this;
    }

    public function setFeelsLike()
    {
        $this->feelsLike = [
            'morning' => ceil($this->dailyWeather->feels_like->morn),
            'day' => ceil($this->dailyWeather->feels_like->day),
            'evening' => ceil($this->dailyWeather->feels_like->eve),
            'night' => ceil($this->dailyWeather->feels_like->night),
        ];
        return $this;
    }

    protected function setText()
    {
        $this->text = "<b>$this->day</b>" . PHP_EOL;
        $this->text .= PHP_EOL;

        $this->text .= 'Максимальная температура: ' . $this->temp['max'] . $this->cels .  PHP_EOL;
        $this->text .= 'Минимальная температура: ' . $this->temp['min'] . $this->cels .PHP_EOL;
        $this->text .= PHP_EOL;

        $this->text .= 'Утром: ' . $this->temp['morning'] . $this->cels . PHP_EOL;
        $this->text .= 'Днем: ' . $this->temp['day'] . $this->cels . PHP_EOL;
        $this->text .= 'Вечером: ' . $this->temp['evening'] . $this->cels . PHP_EOL;
        $this->text .= 'Ночью: ' . $this->temp['night'] . $this->cels . PHP_EOL;
        $this->text .= PHP_EOL;
    }

    public function getText()
    {
        return $this->text;
    }




}
