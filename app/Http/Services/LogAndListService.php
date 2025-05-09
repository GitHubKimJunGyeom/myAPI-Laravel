<?php

namespace App\Http\Services;

use App\Contracts\Services\LogAndListServiceInterface;
use App\Contracts\Services\GoogleAnalyticsServiceInterface;
use Illuminate\Support\Facades\Log;

class LogAndListService implements LogAndListServiceInterface
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
    public function __construct(GoogleAnalyticsServiceInterface $googleAnalyticsServiceInterface) 
    {
        $this->googleAnalyticsServiceInterface = $googleAnalyticsServiceInterface;
    }

    /**
     * Get the Log&List Metrics data.
     *
     * @return array
     */
    public function getMetricsData(): array
    {
        $logAndListMetricsData = $this->googleAnalyticsServiceInterface->getLogAndListMetricsData();
        
        Log::info('Log&List Google Analytics Metrics Data', $logAndListMetricsData);
        
        return [
            'logAndListMetricsData' => $logAndListMetricsData
        ];
    }
}
