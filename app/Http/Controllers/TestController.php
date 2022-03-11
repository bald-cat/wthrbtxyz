<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramRequest;
use App\Services\Telegram\Keyboard;
use App\Services\Telegram\Message;
use App\Services\Weather\CurrentWeather;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function test()
    {

        $replyMarkup = [
                'keyboard' => [
                    'text' => 'Отправить местоположение',
                    'request_location' => true,
                ],
        ];

        $keyboard = new Keyboard();
        $keyboard->setChatId('254096181')->setText('test')->setReplyMarkup(json_encode($replyMarkup))->send();
    }

}
