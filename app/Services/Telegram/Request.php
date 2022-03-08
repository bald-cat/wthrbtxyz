<?php

namespace App\Services\Telegram;

use Illuminate\Http\Request as LaravelRequest;

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
    }

    public function setInputMap()
    {
        $this->map = [
            'chat_id' => $this->request['message']['chat']['id'],
            'message' => $this->request['message']['text'],
        ];

    }

    public function input($key)
    {
        return $this->map[$key];
    }

}
