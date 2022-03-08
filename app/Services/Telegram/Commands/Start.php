<?php

namespace App\Services\Telegram\Commands;

use App\Services\Telegram\Message;
use Illuminate\Support\Facades\Lang;

class Start
{

    protected Message $message;
    protected string $answer;

    const ROUTE = '/start';

    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->answer = Lang::get('commands.start');
    }

    public function start($chat_id)
    {
        $this->message->setChatId($chat_id)->setText($this->answer)->send();
    }

}
