<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Compilations\LocationSummary;
use App\Services\Telegram\Compilations\MainSummary;
use App\Services\Telegram\Request;

class WebhookController extends Controller
{

    public function index(Request $request)
    {
            if($request->input('message') == Start::ROUTE) {
                app('start')->start();
            } elseif ($request->input('latitude') != null && $request->input('longitude') != null) {
                (new LocationSummary($request->input('chat_id'), $request->input('longitude'), $request->input('latitude')))->list();
            } else {
                (new MainSummary($request->input('chat_id'), $request->input('message')))->list();
            }

    }

}
