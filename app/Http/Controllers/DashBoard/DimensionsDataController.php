<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Contracts\Services\DashBoard\DimensionsDataServiceInterface as DashBoardDimensionsDataServiceInterface;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class DimensionsDataController extends Controller
{
    /**
     * The dashboard-dimensions-data service implementation.
     *
     * @var DashBoardDimensionsDataServiceInterface
     */
    protected $dashBoardDimensionsServiceInterface;

    /**
     * Create a new class instance.
     */
    public function __construct(DashBoardDimensionsDataServiceInterface $dashBoardDimensionsServiceInterface)
    {
        $this->dashBoardDimensionsServiceInterface = $dashBoardDimensionsServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analyticsData = $this->dashBoardDimensionsServiceInterface->getDimensionsData();
        Log::info('Dashboard data', $analyticsData);
        $viewData = [
            'analyticsData' => $analyticsData
        ];
        return Inertia::render('DashBoard/index', $viewData);
    }
}
