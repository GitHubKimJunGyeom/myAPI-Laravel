<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\DashboardServiceInterface;
use App\Contracts\Services\LogAndListServiceInterface;
use App\Http\Services\DashboardService;
use App\Http\Services\LogAndListService;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DashboardServiceInterface::class, DashboardService::class);
        $this->app->singleton(LogAndListServiceInterface::class, LogAndListService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
