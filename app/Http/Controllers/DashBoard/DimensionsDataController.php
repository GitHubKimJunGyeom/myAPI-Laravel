<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Services\DashBoard\DimensionsDataServiceInterface as DashBoardDimensionsDataServiceInterface;
use App\Contracts\Services\LogAndList\CommentsServiceInterface as LogAndListCommentsServiceInterface;
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
     * The log and list comments service implementation.
     *
     * @var LogAndListCommentsServiceInterface
     */
    protected $logAndListCommentsServiceInterface;

    /**
     * Create a new class instance.
     */
    public function __construct(DashBoardDimensionsDataServiceInterface $dashBoardDimensionsServiceInterface,
                                LogAndListCommentsServiceInterface $logAndListCommentsServiceInterface)
    {
        $this->dashBoardDimensionsServiceInterface = $dashBoardDimensionsServiceInterface;
        $this->logAndListCommentsServiceInterface = $logAndListCommentsServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $analyticsData = $this->dashBoardDimensionsServiceInterface->getDimensionsData();
        $logAndListCommentsList = $this->logAndListCommentsServiceInterface->index();
        
        Log::info('Dashboard data', $analyticsData);
        Log::info('Log&List Comments data', $logAndListCommentsList);

        $viewData = [
            'analyticsData' => $analyticsData,
            'logAndListCommentsList' => $logAndListCommentsList,
        ];
        return Inertia::render('Dashboard', $viewData);
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
