<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Message;
use App\Services\Telegram\Request;

class TimerController extends Controller
{

    public function index(Request $request)
    {
            $message = new Message();
        if ($request->input('message') == '/start') {
            $message->setChatId($request->input('chat_id'))->setText("Привет. Через сколько секунд ответить тебе?")->send();
        } else {
            $minutes = $request->input('message');

            $message->setChatId($request->input('chat_id'))->setText("Напомню через $minutes секунд")->send();
            //$seconds = $minutes * 60;
            $seconds = $request->input('message');
            sleep($seconds);
            $message->setChatId($request->input('chat_id'))->setText("$minutes секунд(а) прошло")->send();
        }
    }

}
