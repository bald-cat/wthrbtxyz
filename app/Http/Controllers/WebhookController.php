<?php

namespace App\Http\Controllers;

use App\Facades\TelegramMessage;
use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Compilations\LocationSummary;
use App\Services\Telegram\Compilations\MainSummary;
use App\Services\Telegram\Request;
use App\Services\Weather\SevenDaysWeather;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    public function index(Request $request)
    {
            if($request->input('message') == Start::ROUTE) {
                app('start')->start();
            } elseif ($request->input('latitude') != null && $request->input('longitude') != null) {
                (new LocationSummary($request->input('chat_id'), $request->input('longitude'), $request->input('latitude')))->list();
            } elseif ($request->input('callback_data')) {
                $sevenDays = new SevenDaysWeather($request->input('callback_data'));
                $text = $sevenDays->getDigest();
                TelegramMessage::setChatId($request->input('callback_id'))->setText($text)->send();
            } else {
                (new MainSummary($request->input('chat_id'), $request->input('message')))->list();
            }

    }

}
