<?php

namespace App\Http\Services;

use App\Contracts\Services\DashboardServiceInterface;

class DashboardService implements DashboardServiceInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getDashboardData(): array
    {
        return [
            'test' => 'test'
        ];
    }
}
