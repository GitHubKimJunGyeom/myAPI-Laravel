<?php

namespace App\Http\Controllers\LogAndList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Contracts\Services\LogAndList\PathNotesServiceInterface as LogAndListPathNotesServiceInterface;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LogAndList\PathNoteRequest;

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
        $logAndListPathNotesList = $this->logAndListPathNotesServiceInterface->index();
        Log::info('Log&List Path Note data', $logAndListPathNotesList);
        $viewData = [
            'logAndListPathNotesList' => $logAndListPathNotesList,
        ];
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
    public function store(PathNoteRequest $request)
    {
        $validatedData = $request->validated();
        Log::info('Log&List Path Note created', $validatedData);
        $this->logAndListPathNotesServiceInterface->store($validatedData);
        return redirect()->route('logandlist.path-notes-data.index')->with('success', 'Path Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pathNote = $this->logAndListPathNotesServiceInterface->show($id);
        Log::info('Log&List Path Note data', $pathNote->toArray());
        $viewData = [
            'logAndListPathNote' => $pathNote,
        ];
        return Inertia::render('LogAndList/PathNotes/show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pathNote = $this->logAndListPathNotesServiceInterface->show($id);
        Log::info('Log&List Path Note data for edit', $pathNote->toArray());
        $viewData = [
            'logAndListPathNote' => $pathNote,
        ];
        return Inertia::render('LogAndList/PathNotes/edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PathNoteRequest $request, string $id)
    {
        $validatedData = $request->validated();
        Log::info('Log&List Path Note updated', array_merge(['id' => $id], $validatedData));
        $this->logAndListPathNotesServiceInterface->update($validatedData, $id);
        return redirect()->route('logandlist.path-notes-data.show', $id)->with('success', 'Path Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->logAndListPathNotesServiceInterface->destroy($id);
        Log::info('Log&List Path Note deleted', ['id' => $id]);
        return redirect()->route('logandlist.path-notes-data.index')->with('success', 'Path Note deleted successfully.');
    }
}
