<?php

namespace App\Http\Controllers\LogAndList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Contracts\Services\LogAndList\MetricsDataServiceInterface as LogAndListMetricsDataServiceInterface;

class DimensionsDataController extends Controller
{
    /**
     * The Log&List service instance.
     *
     * @var \App\Contracts\Services\LogAndList\MetricsDataServiceInterface
     */
    protected $logAndListMetricsDataServiceInterface;

    public function __construct(LogAndListMetricsDataServiceInterface $logAndListMetricsDataServiceInterface)
    {
        $this->logAndListMetricsDataServiceInterface = $logAndListMetricsDataServiceInterface;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metricsData = $this->logAndListMetricsDataServiceInterface->getMetricsData();
        Log::info('Log&List metricsData', $metricsData);
        return Inertia::render('LogAndList/index', $metricsData);
    }
}
