<?php

namespace App\Http\Services\DashBoard;

use App\Contracts\Services\DashBoard\DimensionsDataServiceInterface as DashBoardDimensionsDataServiceInterface;
use App\Contracts\Services\Google\AnalyticsServiceInterface as GoogleAnalyticsServiceInterface;
use Illuminate\Support\Facades\Log;

class DimensionsDataService implements DashBoardDimensionsDataServiceInterface
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
     * Get the dashboard-dimensions-data data.
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
