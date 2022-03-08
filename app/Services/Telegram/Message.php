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

    public function send()
    {
        TelegramRequest::request(self::METHOD, [
            'chat_id' => $this->chat_id,
            'text' => $this->text,
            'parse_mode' => 'HTML',
        ]);
    }

}
