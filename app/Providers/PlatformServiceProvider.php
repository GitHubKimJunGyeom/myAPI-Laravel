<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

//interfaces(Repositories)
use App\Contracts\Repositories\LogAndList\CommentsRepositoryInterface as LogAndListCommentsRepositoryInterface;
use App\Contracts\Repositories\LogAndList\PathNotesRepositoryInterface as LogAndListPathNotesRepositoryInterface;

//interfaces(Service)
use App\Contracts\Services\DashBoard\DimensionsDataServiceInterface as DashBoardDimensionsDataServiceInterface;
use App\Contracts\Services\KJKPortfolio\MetricsDataServiceInterface as KJKPortfolioMetricsDataServiceInterface;
use App\Contracts\Services\LogAndList\MetricsDataServiceInterface as LogAndListMetricsDataServiceInterface;
use App\Contracts\Services\LogAndList\CommentsServiceInterface as LogAndListCommentsServiceInterface;
use App\Contracts\Services\LogAndList\PathNotesServiceInterface as LogAndListPathNotesServiceInterface;

//Services
use App\Services\DashBoard\DimensionsDataService as DashBoardDimensionsDataService;
use App\Services\KJKPortfolio\MetricsDataService as KJKPortfolioMetricsDataService;
use App\Services\LogAndList\MetricsDataService as LogAndListMetricsDataService;
use App\Services\LogAndList\CommentsService as LogAndListCommentsService;
use App\Services\LogAndList\PathNotesService as LogAndListPathNotesService;

//Repositories
use App\Repositories\LogAndList\CommentsRepository as LogAndListCommentsRepository;
use App\Repositories\LogAndList\PathNotesRepository as LogAndListPathNotesRepository;

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
        $this->app->singleton(LogAndListPathNotesServiceInterface::class, LogAndListPathNotesService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(LogAndListCommentsRepositoryInterface::class, LogAndListCommentsRepository::class);
        $this->app->bind(LogAndListPathNotesRepositoryInterface::class, LogAndListPathNotesRepository::class);
    }
}
