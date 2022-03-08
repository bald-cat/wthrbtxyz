<?php

namespace App\Helpers;

class TelegramRequest
{

        /**
         * Return request from tg-bot using Webhook
         *
         * @param string $method
         * @param bool|array $data
         * @return mixed
         */
        public static function request(string $method, bool|array $data = false): mixed
        {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . config('tg.token') .  '/' . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $request = json_decode(curl_exec($curl), true);

        curl_close($curl);
        return $request;
    }

}
