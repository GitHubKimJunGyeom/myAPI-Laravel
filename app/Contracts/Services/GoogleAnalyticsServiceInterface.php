<?php

namespace App\Contracts\Services;

interface GoogleAnalyticsServiceInterface
{
    //kjk-portfolio
    public function getKjkPortfolioData(): array;
    
    // Log&List
    public function getLogAndListData(): array;
    
    /**
     * Google Analytics API
     */
    public function getAnalyticsData(string $propertyId): array;
}
