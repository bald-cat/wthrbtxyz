<?php

namespace App\Http\Controllers;

use App\Models\TelegramUser;
use App\Services\Telegram\Message;

class TestController extends Controller
{

    public function test()
    {

        $text = "<br>Обновление!<br> Теперь информация о погоде выводится одним сообщением.";
        $message = new Message();
        $users = TelegramUser::all();

        foreach ($users as $user) {
            $message->setText($text)->setChatId($user->chat_id)->send();
        }


    }

}
