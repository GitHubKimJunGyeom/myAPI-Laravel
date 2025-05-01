<?php

namespace App\Contracts\Services;

interface GoogleAnalyticsServiceInterface
{
    /**
     * Google Analytics API
     * @return array
     * @throws \Google\ApiCore\ApiException
     */
    public function getAnalyticsData(): array;
}
