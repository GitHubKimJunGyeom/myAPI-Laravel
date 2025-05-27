<?php

namespace App\Contracts\Services\DashBoard;

interface DimensionsDataServiceInterface
{
    /**
     * Get the dimensions data.
     *
     * @return array
     */
    public function getDimensionsData(): array;
}
