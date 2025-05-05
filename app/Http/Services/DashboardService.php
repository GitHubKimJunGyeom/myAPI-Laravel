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
    public function getDimensionsData(): array
    { 
        $kjkPortfolioDimensionsData = $this->googleAnalyticsServiceInterface->getKjkPortfolioDimensionsData();
        $logAndListDimensionsData = $this->googleAnalyticsServiceInterface->getLogAndListDimensionsData();
        
        Log::info('KJK-Portfolio Google Analytics Data', $kjkPortfolioDimensionsData);
        Log::info('Log&List Google Analytics Data', $logAndListDimensionsData);
        
        return [
            'kjkPortfolioDimensionsData' => $kjkPortfolioDimensionsData,
            'logAndListDimensionsData' => $logAndListDimensionsData,
        ];
    }
}
