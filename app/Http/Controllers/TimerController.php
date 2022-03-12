<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramRequest;
use App\Services\Telegram\Message;
use App\Services\Telegram\Request;

class TimerController extends Controller
{

    public function index()
    {

        $request = file_get_contents('php://input');
        $request = json_decode($request, true);

        if ($request['message']['text'] == '/start') {
            $this->request('sendMessage', [
                    'chat_id' => $request['message']['chat']['id'],
                    'text' => 'Привет! Через сколько секунд ответить тебе?',
                    'parse_mode' => 'HTML',
            ]);
        } else {
            $minutes = $request['message']['text'];
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Напомню через $minutes секунд",
                'parse_mode' => 'HTML',
            ]);
            //$seconds = $minutes * 60;
            $seconds = $request['message']['text'];
            sleep($seconds);
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "$seconds секунд прошло.",
                'parse_mode' => 'HTML',
            ]);
        }
    }

    /**
     * Return request from tg-bot using Webhook
     *
     * @param string $method
     * @param bool|array $data
     * @return mixed
     */
    public function request(string $method, bool|array $data = false): mixed
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . '5274722935:AAH73J-ITTB3c0IPP40FMW3DJX3stktxFXw' .  '/' . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $request = json_decode(curl_exec($curl), true);

        curl_close($curl);
        return $request;
    }

}
