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
        Log::info(json_encode($this->request));
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
            'chat_id' => $this->request['message']['chat']['id'] ?? null,
            'message' => $this->request['message']['text'] ?? null,
            'username' => $this->request['message']['from']['username'] ?? null,
            'language_code' => $this->request['message']['from']['language_code'] ?? null,
            'longitude' => $this->request['message']['location']['longitude'] ?? null,
            'latitude' => $this->request['message']['location']['latitude'] ?? null,
        ];

    }

    public function input($key)
    {
        return $this->map[$key];
    }

}
