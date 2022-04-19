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

    const CELSIUM = "&#8451;";

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
            'max' => $this->dailyWeather->temp->max,
            'min' => $this->dailyWeather->temp->min,
            'morning' => $this->dailyWeather->temp->morn,
            'day' => $this->dailyWeather->temp->day,
            'evening' => $this->dailyWeather->temp->eve,
            'night' => $this->dailyWeather->temp->night,
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
            'morning' => $this->dailyWeather->feels_like->morn,
            'day' => $this->dailyWeather->feels_like->day,
            'evening' => $this->dailyWeather->feels_like->eve,
            'night' => $this->dailyWeather->feels_like->night,
        ];
        return $this;
    }

    protected function setText()
    {
        $this->text = "<b>$this->day</b>" . PHP_EOL;
        $this->text .= PHP_EOL;

        $this->text .= 'Максимальная температура: ' . $this->temp['max'] . PHP_EOL;
        $this->text .= 'Минимальная температура: ' . $this->temp['min'] . PHP_EOL;
        $this->text .= PHP_EOL;

        $this->text .= 'Утром: ' . $this->temp['morning'] . PHP_EOL;
        $this->text .= 'Днем: ' . $this->temp['day'] . PHP_EOL;
        $this->text .= 'Вечером: ' . $this->temp['evening'] . PHP_EOL;
        $this->text .= 'Ночью: ' . $this->temp['night'] . PHP_EOL;
        $this->text .= PHP_EOL;
    }

    public function getText()
    {
        return $this->text;
    }




}
