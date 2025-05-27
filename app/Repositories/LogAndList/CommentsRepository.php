<?php

namespace App\Repositories\LogAndList;
use App\Models\LogAndList\Comments;
use App\Contracts\Repositories\LogAndList\CommentsRepositoryInterface as LogAndListCommentsRepositoryInterface;
use Illuminate\Support\Facades\Log;

class CommentsRepository implements LogAndListCommentsRepositoryInterface
{
    /**
     * The comments model instance.
     *
     * @var \App\Models\LogAndList\Comments
     */
    protected $comments;

    /**
     * Create a new class instance.
     */
    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }
    /**
     * Get all comments.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->comments->all();
    }

    /**
     * Store a new comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store($request)
    {
        $this->comments->user_id = $request->user()->id;
        $this->comments->nickname = $request->input('nickname');
        $this->comments->password_hash = bcrypt($request->input('password'));
        $this->comments->content = $request->input('content');
        $this->comments->page_id = $request->input('page_id');
        $this->comments->parent_id = $request->input('parent_id');
        $this->comments->save();

        return $this->comments;
    }

    /**
     * Get a comment by ID.
     *
     * @param  int  $id
     * @return \App\Models\LogAndList\Comments
     */
    public function show($id)
    {
        return $this->comments->findOrFail($id);
    }

    /**
     * Update a comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\Models\LogAndList\Comments
     */
    public function update($request, $id)
    {
        $comment = $this->comments->findOrFail($id);
        $comment->content = $request->input('content');
        $comment->save();

        return $comment;
    }
    /**
     * Delete a comment.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id)
    {
        $comment = $this->comments->findOrFail($id);
        return $comment->delete();
    }

    /**
     * Restore a soft-deleted comment.
     *
     * @param  int  $id
     * @return bool
     */
    public function restore($id)
    {
        $comment = $this->comments->withTrashed()->findOrFail($id);
        return $comment->restore();
    }   

    /**
     * Force delete a comment.
     *
     * @param  int  $id
     * @return bool
     */
    public function forceDelete($id)
    {
        $comment = $this->comments->withTrashed()->findOrFail($id);
        return $comment->forceDelete();
    }

    /**
     * Get comments by page ID.
     *
     * @param  string  $pageId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCommentsByPageId($parentId)
    {
        return $this->comments->where('parent_id', $parentId)->get();
    }
    /**
     * Get comments by page ID and parent ID.
     *
     * @param  string  $pageId
     * @param  int  $parentId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCommentsByPageIdAndParentId($pageId, $parentId)
    {
        return $this->comments->where('page_id', $pageId)
            ->where('parent_id', $parentId)
            ->get();
    }

}
