<?php

namespace App\Http\Controllers\LogAndList;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Contracts\Services\LogAndList\PathNotesServiceInterface as LogAndListPathNotesServiceInterface;
use App\Http\Resources\LogAndList\PathNoteResource as LogAndListPathNoteResource;
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
        $logAndListPathNoteCollection = $this->logAndListPathNotesServiceInterface->index();
        $logAndListPathNoteList = LogAndListPathNoteResource::collection($logAndListPathNoteCollection)->toArray(request());
        $viewData = [
            'logAndListPathNotesList' => $logAndListPathNoteList,
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
        $logAndListPathNoteCollection = $this->logAndListPathNotesServiceInterface->show($id);
        $logAndListPathNote = new LogAndListPathNoteResource($logAndListPathNoteCollection)->toArray(request());
        Log::info('Log&List Path Note data', $logAndListPathNote);
        $viewData = [
            'logAndListPathNote' => $logAndListPathNote,
        ];
        return Inertia::render('LogAndList/PathNotes/show', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $logAndListPathNoteCollection = $this->logAndListPathNotesServiceInterface->show($id);
        $logAndListPathNote = new LogAndListPathNoteResource($logAndListPathNoteCollection)->toArray(request());
        Log::info('Log&List Path Note data for edit', $logAndListPathNote);
        $viewData = [
            'logAndListPathNote' => $logAndListPathNote,
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

    /**
     * Get all path notes.
     *
     * @return array
     */
    public function getAllPathNote():Array
    {
        Log::info('Log&List Get All Path Note');
        $logAndListPathNoteCollection = $this->logAndListPathNotesServiceInterface->index();
        return LogAndListPathNoteResource::collection($logAndListPathNoteCollection)->toArray(request());
    }

    /**
     * Get a specific path note by ID.
     *
     * @param string $id
     * @return array
     */
    public function getPathNote(string $id):Array
    {
        Log::info('Log&List Get Path Note', ['id' => $id]);
        $logAndListPathNoteCollection = $this->logAndListPathNotesServiceInterface->show($id);
        return  new LogAndListPathNoteResource($logAndListPathNoteCollection)->toArray(request());
    }
}
