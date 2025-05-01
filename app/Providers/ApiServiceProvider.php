<?php

namespace App\Providers;

use App\Contracts\Services\GoogleAnalyticsServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\GoogleAnalyticsService;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //singleton
        $this->app->singleton(GoogleAnalyticsServiceInterface::class, GoogleAnalyticsService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
