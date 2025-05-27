<?php

namespace App\Repositories\LogAndList;
use App\Models\LogAndList\PathNotes;
use App\Contracts\Repositories\LogAndList\PathNotesRepositoryInterface as LogAndListPathNotesRepositoryInterface;

class PathNotesRepository implements LogAndListPathNotesRepositoryInterface
{
    /**
     * The path note model instance.
     *
     * @var \App\Models\LogAndList\PathNotes
     */
    protected $pathNotes;

    /**
     * Create a new class instance.
     *
     * @param  \App\Models\LogAndList\PathNotes  $pathNotes
     */
    public function __construct(PathNotes $pathNotes)
    {
        $this->pathNotes = $pathNotes;
    }

    /**
     * Get all path notes.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->pathNotes->orderByDesc('created_at')->get();
    }
    
    /**
     * Store a new path note.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store($request)
    {
        $this->pathNotes->title = $request['title'] ?? null;
        $this->pathNotes->content_ko = $request['content_ko'] ?? null;
        $this->pathNotes->content_ja = $request['content_ja'] ?? null;
        $this->pathNotes->save();

        return $this->pathNotes;
    }

    /**
     * Get a path note by ID.
     *
     * @param  int  $id
     * @return \App\Models\LogAndList\PathNotes
     */
    public function show($id)
    {
        return $this->pathNotes->findOrFail($id);
    }

    /**
     * Update a path note.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($request, $id)   
    {
        $this->pathNotes = $this->pathNotes->findOrFail($id);
        $this->pathNotes->title = $request['title'] ?? null;
        $this->pathNotes->content_ko = $request['content_ko'] ?? null;
        $this->pathNotes->content_ja = $request['content_ja'] ?? null;
        $this->pathNotes->save();

        return $this->pathNotes;
    }

    /**
     * Delete a path note.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id)
    {
        $pathNotes = $this->pathNotes->findOrFail($id);
        return $pathNotes->delete();
    }
}
