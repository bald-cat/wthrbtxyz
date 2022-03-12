<?php

namespace App\Services\Telegram;

use App\Models\TelegramUser;
use Illuminate\Http\Request as LaravelRequest;
use Illuminate\Support\Facades\Log;

class Request
{

    protected array $request;
    protected array $map;

    public function __construct()
    {
        $request = file_get_contents('php://input');
        $request = json_decode($request, true);
        $this->request = $request;
        $this->setInputMap();
        TelegramUser::query()->updateOrCreate([
            'chat_id' => $this->input('chat_id')
        ], [
            'name' => $this->input('username'),
            'language_code' => $this->input('language_code'),
        ]);
    }

    public function setInputMap()
    {
        $this->map = [
            'chat_id' => $this->request['message']['chat']['id'],
            'message' => $this->request['message']['text'],
            'username' => $this->request['message']['from']['username'],
            'language_code' => $this->request['message']['from']['language_code'],
            'longitude' => $this->request['location']['longitude'] ?? null,
            'latitude' => $this->request['location']['latitude'] ?? null,
        ];

    }

    public function input($key)
    {
        return $this->map[$key];
    }

}
