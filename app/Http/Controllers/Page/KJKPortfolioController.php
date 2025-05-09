<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use App\Contracts\Services\KJKPortfolioServiceInterface;

class KJKPortfolioController extends Controller
{

    /**
     * The KJK-Portfolio service instance.
     *
     * @var \App\Contracts\Services\KJKPortfolioServiceInterface
     */
    protected $kJKPortfolioServiceInterface;

    /**
     * Create a new class instance.
     *
     * @param \App\Contracts\Services\KJKPortfolioServiceInterface $kJKPortfolioServiceInterface
     */
    public function __construct(KJKPortfolioServiceInterface $kJKPortfolioServiceInterface)
    {
        $this->kJKPortfolioServiceInterface = $kJKPortfolioServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metricsData = $this->kJKPortfolioServiceInterface->getMetricsData();
        Log::info('KJK-Portfolio metricsData', $metricsData);
        return Inertia::render('KJKPortfolio', $metricsData);
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
