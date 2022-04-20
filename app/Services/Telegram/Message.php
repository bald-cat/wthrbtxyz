<?php

namespace App\Services\Telegram;

use App\Helpers\TelegramRequest;

class Message
{

    private string $chat_id;
    private string $text;

    const METHOD = 'sendMessage';

    public function setChatId($chat_id): static
    {
        $this->chat_id =  $chat_id;
        return $this;
    }

    public function setText($text): static
    {
        $this->text = $text;
        return $this;
    }

    public function send($inlineButton = false)
    {

        $parameters = [
            'chat_id' => $this->chat_id,
            'text' => $this->text,
            'parse_mode' => 'HTML',
        ];

        if ($inlineButton) {

            $weekButton = [
                'text' => 'Получить погоду на неделю',
                'callback_data' => 'Киев',
            ];

            $inlineKeyboard = [[$weekButton]];
            $keyboard = [
                'inline_keyboard' => $inlineKeyboard,
            ];
            $replyMarkup = json_encode($keyboard);

            $parameters['reply_markup'] = $replyMarkup;
        }

        TelegramRequest::request(self::METHOD, $parameters);
    }

}
