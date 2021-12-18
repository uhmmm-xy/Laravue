<?php

namespace App\Providers;

use App\Models\Game\NoticeModel;
use Illuminate\Support\ServiceProvider;
use Services\Observers\Games\NoticeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        NoticeModel::observe(NoticeObserver::class);
    }
}
