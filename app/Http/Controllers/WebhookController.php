<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    public function index(Request $request)
    {

        Log::info('111');
        if ($request->input('message') == Start::ROUTE) {
            Log::info('222');
            app('start')->start();
        } else {
            app('main-summary')->list();
        }

    }

}
