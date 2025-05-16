<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

//interfaces(Repository)
use App\Contracts\Repository\LogAndList\CommentsRepositoryInterface as LogAndListCommentsRepositoryInterface;

//interfaces(Service)
use App\Contracts\Services\DashBoard\DimensionsDataServiceInterface as DashBoardDimensionsDataServiceInterface;
use App\Contracts\Services\KJKPortfolio\MetricsDataServiceInterface as KJKPortfolioMetricsDataServiceInterface;
use App\Contracts\Services\LogAndList\MetricsDataServiceInterface as LogAndListMetricsDataServiceInterface;
use App\Contracts\Services\LogAndList\CommentsServiceInterface as LogAndListCommentsServiceInterface;

//Services
use App\Http\Services\DashBoard\DimensionsDataService as DashBoardDimensionsDataService;
use App\Http\Services\KJKPortfolio\MetricsDataService as KJKPortfolioMetricsDataService;
use App\Http\Services\LogAndList\MetricsDataService as LogAndListMetricsDataService;
use App\Http\Services\LogAndList\CommentsService as LogAndListCommentsService;

//Repository
use App\Http\Repository\LogAndList\CommentsRepository as LogAndListCommentsRepository;

class PlatformServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(DashBoardDimensionsDataServiceInterface::class, DashBoardDimensionsDataService::class);
        $this->app->singleton(KJKPortfolioMetricsDataServiceInterface::class, KJKPortfolioMetricsDataService::class);
        $this->app->singleton(LogAndListMetricsDataServiceInterface::class, LogAndListMetricsDataService::class);
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
