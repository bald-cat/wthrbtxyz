<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Compilations\MainSummary;
use App\Services\Telegram\Message;
use App\Services\Telegram\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    public function index(Request $request)
    {
            if($request->input('message') == Start::ROUTE) {
                app('start')->start();
            } elseif ($request->input('longitude')) {
                app('start')->start();
            } else {
                (new MainSummary($request->input('chat_id'), $request->input('message')))->list();
            }

    }

}
