<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Contracts\Services\LogAndListServiceInterface;

class LogAndListController extends Controller
{
    protected $logAndListInterface;

    public function __construct(LogAndListServiceInterface $logAndListInterface)
    {
        $this->logAndListInterface = $logAndListInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $metricsData = $this->logAndListInterface->getMetricsData();
        Log::info('Log&List metricsData', $metricsData);
        return Inertia::render('LogAndList', $metricsData);
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
