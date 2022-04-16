<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramRequest;
use App\Models\TelegramUser;
use App\Services\Telegram\Compilations\MainSummary;
use App\Services\Telegram\Message;

class TestController extends Controller
{

    public function test()
    {

        $text = "<b>Обновление!<b> Теперь информация о погоде выводится одним сообщением. Для примера погода в Киеве:";
        $message = new Message();
        $users = TelegramUser::all();

        foreach ($users as $user) {
            TelegramRequest::request('sendMessage', [
                'chat_id' => $user->chat_id,
                'text' => "*Обновление!* Теперь информация о погоде выводится одним сообщением. Для примера погода в Киеве:",
                'parse_mode' => 'Markdown',
            ]);
            $message->setText($text)->setChatId($user->chat_id)->send();
            (new MainSummary($user->chat_id, 'Киев'))->list();
        }


    }

}
