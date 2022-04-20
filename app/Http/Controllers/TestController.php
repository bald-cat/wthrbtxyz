<?php

namespace App\Http\Controllers;

use App\Facades\TelegramMessage;
use App\Services\Weather\CurrentWeather;
use App\Services\Weather\SevenDaysWeather;
use Illuminate\Support\Facades\Cache;

class TestController extends Controller
{

    public function test()
    {
        /*$test = new SevenDaysWeather('Киев');
        $arr = $test->getDigest();
        TelegramMessage::setChatId('254096181')->setText($arr)->send(true);*/

        dd(Cache::get('test'));
    }

}
