<?php

namespace App\Http\Services;

use App\Contracts\Services\DashboardServiceInterface;
use App\Contracts\Services\GoogleAnalyticsServiceInterface;
use Illuminate\Support\Facades\Log;

class DashboardService implements DashboardServiceInterface
{
    /**
     * The Google Analytics service instance.
     *
     * @var \App\Contracts\Services\GoogleAnalyticsServiceInterface
     */
    protected $googleAnalyticsServiceInterface;
    
    /**
     * Create a new class instance.
     */
    public function __construct(GoogleAnalyticsServiceInterface $googleAnalyticsServiceInterface) {
        $this->googleAnalyticsServiceInterface = $googleAnalyticsServiceInterface;
    }

    /**
     * Get the dashboard data.
     *
     * @return array
     */
    public function getDashboardData(): array
    {
        $data = $this->googleAnalyticsServiceInterface->getKjkPortfolioData();
        Log::info('Google Analytics Data', $data);
        return [
            'analyticsData' => $data,
        ];
    }
}
