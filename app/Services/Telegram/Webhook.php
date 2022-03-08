<?php

namespace App\Services\Telegram;

class Webhook
{

    const METHOD = 'setWebhook';
    const PARAM = '?url';

    private string $link;

    public function __construct()
    {
        $this->link = config('tg.api_link') . config('tg.token') . '/' . self::METHOD . self::PARAM . '=' . config('tg.bot_url') . '/' . config('tg.webhook-url');
    }

    public function setWebhook()
    {
        $contents = file_get_contents($this->link);
        print_r($contents);
    }

}
