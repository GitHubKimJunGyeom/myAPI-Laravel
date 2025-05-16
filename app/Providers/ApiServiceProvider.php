<?php

namespace App\Providers;

use App\Contracts\Services\Google\AnalyticsServiceInterface as GoogleAnalyticsServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Services\Google\AnalyticsService as GoogleAnalyticsService;
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
