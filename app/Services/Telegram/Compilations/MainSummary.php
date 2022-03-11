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

    public function list()
    {
            if ($this->currentWeather->getWeather() != null) {
                $this->message->setText($this->currentWeather->getText())->send();
                $this->message->setText($this->currentWeather->getFeelsLike())->send(true);
                $this->message->setText($this->currentWeather->getSunrise())->send(true);
                $this->message->setText($this->currentWeather->getSunset())->send(true);
                $this->message->setText($this->currentWeather->getWindSpeed())->send(true);
                $this->message->setText($this->currentWeather->getWindDeg())->send(true);
            } else {
                $answer = Lang::get('info.not-find-city');
                $answer = "	\xE2\x9A\xA0 $answer";
                $this->message->setText($answer)->send();
            }
    }
}
