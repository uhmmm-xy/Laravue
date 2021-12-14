<?php

namespace Services\Providers;

use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("games", \Services\Classes\Games::class);
    }
}
