<?php

namespace App\Services\Telegram\Compilations;

use App\Services\Telegram\Message;
use App\Services\Weather\CurrentWeather;
use App\Services\Weather\LocationWeather;
use Illuminate\Support\Facades\Lang;

class LocationSummary
{

    protected LocationWeather $locationWeather;
    protected Message $message;
    protected string $chat_id;

    public function __construct($chat_id, $longitude, $latitude)
    {
        $this->locationWeather = new LocationWeather($longitude, $latitude);
        $this->message = app('message');
        $this->chat_id = $chat_id;
        $this->message->setChatId($this->chat_id);
    }

    public function list()
    {
            if ($this->locationWeather->getWeather() != null) {
                $this->message->setText($this->locationWeather->getText())->send();
                $this->message->setText($this->locationWeather->getFeelsLike())->send(true);
                $this->message->setText($this->locationWeather->getSunrise())->send(true);
                $this->message->setText($this->locationWeather->getSunset())->send(true);
                $this->message->setText($this->locationWeather->getWindSpeed())->send(true);
                $this->message->setText($this->locationWeather->getWindDeg())->send(true);
            } else {
                $answer = Lang::get('info.not-find-city');
                $answer = "\xE2\x9A\xA0 $answer";
                $this->message->setText($answer)->send();
            }
    }
}
