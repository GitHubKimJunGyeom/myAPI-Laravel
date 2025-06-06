<?php

namespace App\Contracts\Services\Google;

interface AnalyticsServiceInterface
{
    //kjk-portfolio(Dimensions)
    public function getKjkPortfolioDimensionsData(): array;
    
    // Log&List(Dimensions)
    public function getLogAndListDimensionsData(): array;

    //kjk-portfolio(Metric)
    public function getKjkPortfolioMetricData(): array;
    
    // Log&List(Metric)
    public function getLogAndListMetricsData(): array;
}
