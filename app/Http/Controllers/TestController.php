<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Message;
use App\Services\Weather\CurrentWeather;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function test()
    {
        $currentWeather = new CurrentWeather('Киев');
        dd($currentWeather->getWeather());
    }

}
