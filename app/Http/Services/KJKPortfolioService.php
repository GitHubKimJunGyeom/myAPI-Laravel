<?php

namespace App\Http\Services;

use App\Contracts\Services\KJKPortfolioServiceInterface;
use App\Contracts\Services\GoogleAnalyticsServiceInterface;
use Illuminate\Support\Facades\Log;

class KJKPortfolioService implements KJKPortfolioServiceInterface
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
     * Get the KJK-Portfolio Metrics data.
     *
     * @return array
     */
    public function getMetricsData(): array
    {
        $kJKPortfolioMetricsData = $this->googleAnalyticsServiceInterface->getKjkPortfolioMetricData();
        
        Log::info('KJK-Portfolio Google Analytics Metrics Data', $kJKPortfolioMetricsData);
        
        return [
            'kJKPortfolioMetricsData' => $kJKPortfolioMetricsData
        ];
    }
}
