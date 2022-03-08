<?php

namespace App\Providers;

use App\Services\Weather\CurrentWeather;
use App\Services\Weather\Geocoding;
use Illuminate\Support\ServiceProvider;

class WeatherProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('geocoding', Geocoding::class);
        $this->app->singleton('current-weather', CurrentWeather::class);
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
