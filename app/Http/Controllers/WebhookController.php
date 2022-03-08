<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Request;

class WebhookController extends Controller
{

    public function index(Request $request)
    {

        if ($request->input('message') == Start::ROUTE) {
            app('start')->start();
        } else {
            app('main-summary')->list();
        }

    }

}
