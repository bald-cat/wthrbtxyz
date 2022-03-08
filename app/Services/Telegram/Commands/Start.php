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

    public function __construct(Message $message, Request $request)
    {
        $this->message = $message;
        $this->answer = Lang::get('commands.start');
        $this->chat_id = $request->input('chat_id');
        Log::info($request);
    }

    public function start()
    {
        Log::info('1');
        $this->message->setChatId($this->chat_id)->setText($this->answer)->send();
    }

}
