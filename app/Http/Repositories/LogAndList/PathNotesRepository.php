<?php

namespace App\Http\Repositories\LogAndList;
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
        return $this->pathNotes->all();
    }
    /**
     * Store a new path note.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store($request)
    {
        $this->pathNotes->title = $request->input('title');
        $this->pathNotes->content_ko = $request->input('content_ko');
        $this->pathNotes->content_ja = $request->input('content_ja');
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
        $pathNotes = $this->pathNotes->findOrFail($id);
        $pathNotes->title = $request->input('title');
        $pathNotes->content_ko = $request->input('content_ko');
        $pathNotes->content_ja = $request->input('content_ja');
        $pathNotes->save();

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
        $pathNotes = $this->pathNotes->findOrFail($id);
        return $pathNotes->delete();
    }

    /**
     * Restore a deleted path note.
     *
     * @param  int  $id
     * @return bool
     */
    public function restore($id)
    {
        $pathNotes = $this->pathNotes->withTrashed()->findOrFail($id);
        return $pathNotes->restore();
    }

    /**
     * Force delete a path note.
     *
     * @param  int  $id
     * @return bool
     */
    public function forceDelete($id)
    {
        $pathNotes = $this->pathNotes->withTrashed()->findOrFail($id);
        return $pathNotes->forceDelete();
    }

}
