<?php

namespace App\Services\KJKPortfolio;

use App\Contracts\Services\KJKPortfolio\MetricsDataServiceInterface as KJKPortfolioMetricsDataServiceInterface;
use App\Contracts\Services\Google\AnalyticsServiceInterface as GoogleAnalyticsServiceInterface;
use Illuminate\Support\Facades\Log;

class MetricsDataService implements KJKPortfolioMetricsDataServiceInterface
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
