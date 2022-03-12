<?php

namespace App\Services\Telegram\Commands;

use App\Helpers\TelegramRequest;
use App\Services\Telegram\Message;
use App\Services\Telegram\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class Start
{

    protected Message $message;
    protected string $answer;
    protected string $chat_id;

    const ROUTE = '/start';

    public function __construct(Request $request, Message $message)
    {
        $this->message = $message;
        $this->answer = Lang::get('commands.start');
        $this->chat_id = $request->input('chat_id');
    }

    public function start()
    {
        $this->message->setChatId($this->chat_id)->setText($this->answer)->send();
        $this->message->setChatId($this->chat_id)->setText("<b>Вот что я умею в данный момент:</b>")->send();
        $this->message->setChatId($this->chat_id)->setText("Определение погоды в городе по его названию \xF0\x9F\x8C\x87")->send();

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
            'chat_id' => $this->chat_id,
            'text' => "Определение погоды на основе местоположения \xF0\x9F\x8C\x8D",
            'reply_markup' => json_encode($replyMarkup),
            'parse_mode' => 'HTML',
        ]);
    }

}
