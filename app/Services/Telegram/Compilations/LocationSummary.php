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
                $text = $this->locationWeather->getText() . PHP_EOL;
                $text .= $this->locationWeather->getFeelsLike() . PHP_EOL;
                $text .= $this->locationWeather->getSunrise() . PHP_EOL;
                $text .= $this->locationWeather->getSunset() . PHP_EOL;
                $text .= $this->locationWeather->getWindSpeed() . PHP_EOL;
                $text .= $this->locationWeather->getWindDeg() . PHP_EOL;

                $this->message->setText($text)->send();
            } else {
                $answer = Lang::get('info.not-find-city');
                $answer = "\xE2\x9A\xA0 $answer";
                $this->message->setText($answer)->send();
            }
    }
}
