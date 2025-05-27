<?php

namespace App\Contracts\Services\KJKPortfolio;

interface MetricsDataServiceInterface
{
    /**
     * Get the metrics data.
     *
     * @return array
     */
    public function getMetricsData(): array;
}
