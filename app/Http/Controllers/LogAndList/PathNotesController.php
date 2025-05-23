<?php

namespace App\Http\Controllers\LogAndList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Contracts\Services\LogAndList\PathNotesServiceInterface as LogAndListPathNotesServiceInterface;
use Illuminate\Support\Facades\Log;

class PathNotesController extends Controller
{
    /**
     * The log and list path note service implementation.
     *
     * @var LogAndListPathNotesServiceInterface
     */
    protected $logAndListPathNotesServiceInterface;

    /**
     * Create a new class instance.
     */
    public function __construct(LogAndListPathNotesServiceInterface $logAndListPathNotesServiceInterface)
    {
        $this->logAndListPathNotesServiceInterface = $logAndListPathNotesServiceInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch path notes data
        $logAndListPathNotesList = $this->logAndListPathNotesServiceInterface->index();
        Log::info('Log&List Path Note data', $logAndListPathNotesList);

        // Prepare view data
        $viewData = [
            'logAndListPathNotesList' => $logAndListPathNotesList,
        ];

        // Render the view
        return Inertia::render('LogAndList/PathNotes/index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('LogAndList/PathNotes/create');
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
