<?php

use App\Http\Controllers\StartController;
use App\Http\Controllers\WebhookController;
use App\Services\Telegram\Webhook;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/set-webhook', [Webhook::class, 'setWebhook'])->name('set-webhook');
Route::get('/webhook', [WebhookController::class, 'index'])->name('webhook');

Route::get('test', [\App\Http\Controllers\TestController::class, 'test'])->name('test');
