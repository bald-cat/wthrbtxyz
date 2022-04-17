<?php

namespace App\Http\Controllers;

use App\Facades\TelegramMessage;
use App\Services\Telegram\Request;
use Illuminate\Support\Facades\Lang;

class StartController extends Controller
{

    public function index(Request $request)
    {
        $answer = Lang::get('commands.start');
        TelegramMessage::setChatId($request->input('chat_id'))->setText($answer)->send();

    }

}
