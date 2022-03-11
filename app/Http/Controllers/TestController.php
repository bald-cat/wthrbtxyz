<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Message;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function test()
    {
        $message = new Message();
        $message->setChatId('108872958')->setText("\xE2\x9D\xA4")->send();
    }

}
