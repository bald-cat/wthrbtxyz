<?php

namespace App\Services\Telegram;

use App\Helpers\TelegramRequest;

class Keyboard {

    protected string $chat_id;
    protected string $text;
    protected $replyMarkup;

    const METHOD = 'sendMessage';

    /**
     * @param string $chat_id
     * @return Keyboard
     */
    public function setChatId(string $chat_id): static
    {
        $this->chat_id = $chat_id;
        return $this;
    }

    /**
     * @param string $text
     * @return Keyboard
     */
    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @param $replyMarkup
     * @return Keyboard
     */
    public function setReplyMarkup($replyMarkup): static
    {
        $this->replyMarkup = $replyMarkup;
        return $this;
    }

    public function send()
    {
        TelegramRequest::request(self::METHOD, [
            'chat_id' => $this->chat_id,
            'text' => $this->text,
            'reply_markup' => $this->replyMarkup
        ]);
    }

}
