<?php

namespace App\Http\Controllers;

class TimerController extends Controller
{

    public function index()
    {

        $keyboard = [
            'keyboard' => [
                [
                    ['text' => 'В смятку'],
                    ['text' => 'В мешочку'],
                    ['text' => 'Вкрутую'],
                ],
            ],
            'resize_keyboard' => true,
            'input_field_placeholder' => 'Как сварить?',
        ];

        $request = file_get_contents('php://input');
        $request = json_decode($request, true);

        if ($request['message']['text'] == '/start') {
            $this->request('sendMessage', [
                    'chat_id' => $request['message']['chat']['id'],
                    'text' => 'Варишь яйца? Не прозевай время! Как хочешь сварить яйцо? Выберите с помощью клавиатуры',
                    'parse_mode' => 'HTML',
                    'reply_markup' => json_encode($keyboard)
            ]);
        } elseif($request['message']['text'] == 'всмятку') {
            $minutes = 3;
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Напомню через $minutes минут",
                'parse_mode' => 'HTML',
            ]);
            sleep($minutes);
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Доставай яйца!",
                'parse_mode' => 'HTML',
            ]);
        } elseif($request['message']['text'] == 'в мешочек') {
            $minutes = 5;
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Напомню через $minutes минут",
                'parse_mode' => 'HTML',
            ]);
            sleep($minutes);
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Доставай яйца!",
                'parse_mode' => 'HTML',
            ]);
        } elseif($request['message']['text'] == 'вкрутую') {
            $minutes = 9;
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Напомню через $minutes минут",
                'parse_mode' => 'HTML',
            ]);
            //$seconds = $minutes * 60;
            $seconds = $request['message']['text'];
            sleep($seconds);
            $this->request('sendMessage', [
                'chat_id' => $request['message']['chat']['id'],
                'text' => "Доставай яйца!",
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
