<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Message;
use App\Services\Telegram\Request;

class TimerController extends Controller
{

    public function index()
    {

        $request = file_get_contents('php://input');
        $request = json_decode($request, true);
            $message = new Message();
        if ($request['message']['text'] == '/start') {
            $message->setChatId($request['message']['chat']['id'])->setText("Привет. Через сколько секунд ответить тебе?")->send();
        } else {
            $minutes = $request['message']['text'];

            $message->setChatId($request['message']['chat']['id'])->setText("Напомню через $minutes секунд")->send();
            //$seconds = $minutes * 60;
            $seconds = $request['message']['text'];
            sleep($seconds);
            $message->setChatId($request['message']['chat']['id'])->setText("$minutes секунд(а) прошло")->send();
        }
    }

}
