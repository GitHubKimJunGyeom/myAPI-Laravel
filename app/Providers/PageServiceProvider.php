<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

//interfaces(Repository)
use App\Contracts\Repository\LogAndListCommentsRepositoryInterface;

//interfaces(Service)
use App\Contracts\Services\DashboardServiceInterface;
use App\Contracts\Services\LogAndListServiceInterface;
use App\Contracts\Services\KJKPortfolioServiceInterface;
use App\Contracts\Services\LogAndListCommentsServiceInterface;

//Services
use App\Http\Services\DashboardService;
use App\Http\Services\LogAndListService;
use App\Http\Services\KJKPortfolioService;
use App\Http\Services\LogAndListCommentsService;

//Repository
use App\Http\Repository\LogAndListCommentsRepository;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DashboardServiceInterface::class, DashboardService::class);
        $this->app->singleton(KJKPortfolioServiceInterface::class, KJKPortfolioService::class);
        $this->app->singleton(LogAndListServiceInterface::class, LogAndListService::class);
        $this->app->singleton(LogAndListCommentsServiceInterface::class, LogAndListCommentsService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(LogAndListCommentsRepositoryInterface::class, LogAndListCommentsRepository::class);
    }
}
