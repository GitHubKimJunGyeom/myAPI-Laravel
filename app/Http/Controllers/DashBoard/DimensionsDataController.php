<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
