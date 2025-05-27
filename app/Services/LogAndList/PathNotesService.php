<?php

namespace App\Services\LogAndList;

use App\Contracts\Services\LogAndList\PathNotesServiceInterface as LogAndListPathNotesServiceInterface;
use App\Contracts\Repositories\LogAndList\PathNotesRepositoryInterface as LogAndListPathNotesRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class PathNotesService implements LogAndListPathNotesServiceInterface
{
    /**
     * The path note repository instance.
     *
     * @var \App\Http\Repositories\LogAndList\PathNotesRepository
     */
    protected $logAndListPathNotesRepositoryInterface;

    /**
     * Create a new class instance.
     *
     * @param  \App\Http\Repositories\LogAndList\PathNotesRepository  $pathNotesRepository
     */
    public function __construct(LogAndListPathNotesRepositoryInterface $logAndListPathNotesRepositoryInterface)
    {
        $this->logAndListPathNotesRepositoryInterface = $logAndListPathNotesRepositoryInterface;
    }

    // Add your service methods here
    /**
     * Get all path notes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $pathNoteCollection = $this->logAndListPathNotesRepositoryInterface->index();
        $pathNotes = $pathNoteCollection->map(function ($pathNote) {
            return [
                'id' => $pathNote->id,
                'title' => $pathNote->title,
                'content_ko' => $pathNote->content_ko,
                'content_ja' => $pathNote->content_ja,
                'created_at' => Carbon::parse($pathNote->created_at)->format('Y-m-d H:i:s'),
            ];
        });
        $pathNotes = $pathNotes->toArray();
        Log::info('Log&List Path Note data', $pathNotes);
        return $pathNotes;
    }

    /**
     * Store a new path note.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\LogAndList\PathNotes
     */
    public function store($request)
    {
        $pathNotes = $this->logAndListPathNotesRepositoryInterface->store($request);
        Log::info('Log&List Path Note created', $pathNotes->toArray());
        return $pathNotes;
    }

    /**
     * Get a path note by ID.
     *
     * @param  int  $id
     * @return \App\Models\LogAndList\PathNotes
     */
    public function show($id)
    {
        $pathNotes = $this->logAndListPathNotesRepositoryInterface->show($id);
        Log::info('Log&List Path Note fetched', $pathNotes->toArray());
        return $pathNotes;
    }

    /**
     * Update a path note.
     *
     * @param  Array  $validatedData
     * @param  int  $id
     * @return \App\Models\LogAndList\PathNotes
     */
    public function update($validatedData, $id)
    {
        $pathNotes = $this->logAndListPathNotesRepositoryInterface->update($validatedData, $id);
        Log::info('Log&List Path Note updated', $pathNotes->toArray());
        return $pathNotes;
    }

    /**
     * Delete a path note.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id)
    {
        $deleted = $this->logAndListPathNotesRepositoryInterface->destroy($id);
        Log::info('Log&List Path Note deleted', ['id' => $id, 'deleted' => $deleted]);
        return $deleted;
    }
}
