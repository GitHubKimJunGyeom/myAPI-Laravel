<?php

namespace App\Http\Controllers\LogAndList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Contracts\Services\LogAndList\CommentsServiceInterface as LogAndListCommentsServiceInterface;
use Illuminate\Support\Facades\Log;

class CommentsController extends Controller
{

    /**
     * The log and list comments service implementation.
     *
     * @var LogAndListCommentsServiceInterface
     */
    protected $logAndListCommentsServiceInterface;

     /**
     * Create a new class instance.
     */
    public function __construct(LogAndListCommentsServiceInterface $logAndListCommentsServiceInterface)
    {
        $this->logAndListCommentsServiceInterface = $logAndListCommentsServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logAndListCommentsList = $this->logAndListCommentsServiceInterface->index();
        Log::info('Log&List Comments data', $logAndListCommentsList);
        $viewData = [
            'logAndListCommentsList' => $logAndListCommentsList,
        ];
        return Inertia::render('LogAndList/Comments/index', $viewData);
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
