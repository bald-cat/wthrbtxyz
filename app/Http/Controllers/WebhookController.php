<?php

namespace App\Http\Controllers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{

    public function index(Request $request)
    {

        file_put_contents('test.txt', '1');
        if ($request->input('message') == Start::ROUTE) {
            file_put_contents('test.txt', '2');
            app('start')->start();
        } else {
            app('main-summary')->list();
        }

    }

}
