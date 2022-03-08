<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    public function index()
    {
        app('start')->start();
    }

}
