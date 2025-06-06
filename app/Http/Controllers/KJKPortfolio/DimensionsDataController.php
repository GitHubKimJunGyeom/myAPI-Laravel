<?php

namespace App\Http\Controllers\KJKPortfolio;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Contracts\Services\KJKPortfolio\MetricsDataServiceInterface as KJKPortfolioMetricsDataServiceInterface;

class DimensionsDataController extends Controller
{
    /**
     * The KJK-Portfolio service instance.
     *
     * @var \App\Contracts\Services\KJKPortfolioMetricsDataServiceInterface
     */
    protected $kJKPortfolioMetricsDataServiceInterface;

    /**
     * Create a new class instance.
     *
     * @param \App\Contracts\Services\KJKPortfolioMetricsDataServiceInterface $kJKPortfolioMetricsDataServiceInterface
     */
    public function __construct(KJKPortfolioMetricsDataServiceInterface $kJKPortfolioMetricsDataServiceInterface)
    {
        $this->kJKPortfolioMetricsDataServiceInterface = $kJKPortfolioMetricsDataServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metricsData = $this->kJKPortfolioMetricsDataServiceInterface->getMetricsData();
        Log::info('KJK-Portfolio metricsData', $metricsData);
        return Inertia::render('KJKPortfolio/index', $metricsData);
    }
}
