<?php

namespace App\Services\Telegram\Compilations;

use App\Services\Telegram\Message;
use App\Services\Weather\CurrentWeather;
use Illuminate\Support\Facades\Lang;

class MainSummary
{

    protected CurrentWeather $currentWeather;
    protected Message $message;
    protected string $chat_id;

    public function __construct($chat_id, $city)
    {
        $this->currentWeather = new CurrentWeather($city);
        $this->message = app('message');
        $this->chat_id = $chat_id;
        $this->message->setChatId($this->chat_id);
    }

    public function list(): void
    {
            if ($this->currentWeather->getWeather() != null) {
                $text = $this->currentWeather->getText() . PHP_EOL;
                $text .= $this->currentWeather->getFeelsLike() . PHP_EOL;
                $text .= $this->currentWeather->getSunrise() . PHP_EOL;
                $text .= $this->currentWeather->getSunset() . PHP_EOL;
                $text .= $this->currentWeather->getWindSpeed() . PHP_EOL;
                $text .= $this->currentWeather->getWindDeg() . PHP_EOL;
                $this->message->setText($text)->send();
            } else {
                $answer = Lang::get('info.not-find-city');
                $answer = "\xE2\x9A\xA0 $answer";
                $this->message->setText($answer)->send();
            }
    }
}
