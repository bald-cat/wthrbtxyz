<?php

namespace App\Providers;

use App\Services\Telegram\Commands\Start;
use App\Services\Telegram\Compilations\MainSummary;
use App\Services\Telegram\Message;
use Illuminate\Support\ServiceProvider;

class TelegramProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('message', Message::class);
        $this->app->singleton('start', Start::class);

        $this->app->singleton('main-summary', MainSummary::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
