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
                [
                        ['text' => "\xF0\x9F\x93\x8D Отправить мою геолокацию",
                     'request_location' => true]
                ],
            ],
            'resize_keyboard' => true,
            'input_field_placeholder' => 'Впишите название города или ...',
        ];

        TelegramRequest::request('sendMessage', [
            'chat_id' => "254096181",
            'text' => '',
            'reply_markup' => json_encode($replyMarkup)
        ]);

    }

}
