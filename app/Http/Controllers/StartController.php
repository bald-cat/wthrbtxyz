<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class StartController extends Controller
{

    protected Message$message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function index(Request $request)
    {
        $tgRequest = $request->getContent();
        $answer = Lang::get('commands.start');
        (new Message())->setChatId("254096181")->setText($answer)->send();
    }

}
