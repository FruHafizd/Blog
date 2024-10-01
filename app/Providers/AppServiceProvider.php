<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mckenziearts\Notify\LaravelNotifyServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(LaravelNotifyServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
