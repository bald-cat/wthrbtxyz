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

        $replyMarkup = array(
            'keyboard' => array(
                array("A", "B")
            )
        );

        $replyMarkup = [
            'keyboard' => [
                [
                        ['text' => "\xF0\x9F\x93\x8D Отправить мою геолокацию",
                     'request_location' => true]
                ],
            'resize_keyboard' => true,
            'input_field_placeholder' => 'Введите название нужного города или Отправьте свое местоположение'
            ]
        ];

        TelegramRequest::request('sendMessage', [
            'chat_id' => "254096181",
            'text' => 'Отправить мою геолокацию',
            'reply_markup' => json_encode($replyMarkup)
        ]);

    }

}
