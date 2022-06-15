<?php

namespace App\Services\Telegram;

use App\Models\TelegramUser;
use Illuminate\Http\Request as LaravelRequest;
use Illuminate\Support\Facades\Cache;
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

        Cache::set('test', $this->request);

        $this->setInputMap();
        if ($this->input('chat_id') != null) {
            TelegramUser::query()->updateOrCreate([
                'chat_id' => $this->input('chat_id')
            ], [
                'name' => $this->input('username') ?? $this->input('first_name') . ' ' . $this->input('last_name'),
                'language_code' => $this->input('language_code'),
            ]);
        }
    }

    public function setInputMap()
    {
        $this->map = [
            'chat_id' => $this->request['message']['chat']['id'] ?? null,
            'message' => $this->request['message']['text'] ?? null,
            'username' => $this->request['message']['from']['username'] ?? null,
            'first_name' => $this->request['message']['from']['first_name'] ?? 'NOT FIRST NAME',
            'last_name' => $this->request['message']['from']['last_name'] ?? 'NOT LAST NAME',
            'language_code' => $this->request['message']['from']['language_code'] ?? 'NOT DATA',
            'longitude' => $this->request['message']['location']['longitude'] ?? null,
            'latitude' => $this->request['message']['location']['latitude'] ?? null,
            'callback_data' => $this->request['callback_query']['data'] ?? null,
            'callback_id' => $this->request['callback_query']['from']['id'] ?? null,
        ];

    }

    public function input($key)
    {
        return $this->map[$key];
    }

}
