<?php

namespace App\Services\Telegram\Commands;

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

    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->answer = Lang::get('commands.start');
        //$this->chat_id = $request->input('chat_id');
    }

    public function start()
    {
        $this->message->setChatId('254096181')->setText($this->answer)->send();
    }

}
