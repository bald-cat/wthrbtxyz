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
            'text' => "<b>Определение местоположения</b>\xF0\x9F\x8C\x8D",
            'reply_markup' => json_encode($replyMarkup),
            'parse_mode' => 'HTML',
        ]);

        $text = "<b>Обновление!</b> Добавлена новая функция. Теперь можно получить погоду для вашего текущего местоположения просто выбрав в меню кнопку Отправить мою геолокацию. Также, можно просто прикрепить геолокацию, выбрав любую точку на карте и получить данные о погоде в этой точке.";
        $message = new Message();
        $message->setChatId('254096181')->setText($text)->send();

    }

}
