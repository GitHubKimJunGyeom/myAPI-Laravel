<?php

namespace App\Http\Controllers\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Services\DashboardServiceInterface;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $dashboardServiceInterface;

    /**
     * Create a new class instance.
     */
    public function __construct(DashboardServiceInterface $dashboardServiceInterface) {
        $this->dashboardServiceInterface = $dashboardServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analyticsData = $this->dashboardServiceInterface->getDimensionsData();
        Log::info('Dashboard data', $analyticsData);
        return Inertia::render('Dashboard', $analyticsData);
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
