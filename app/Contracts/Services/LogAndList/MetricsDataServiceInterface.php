<?php

namespace App\Contracts\Services\LogAndList;

interface MetricsDataServiceInterface
{
    /**
     * Get the metrics data.
     *
     * @return array
     */
    public function getMetricsData(): array;
}
