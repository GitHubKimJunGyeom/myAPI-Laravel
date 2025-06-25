<?php

namespace App\Services\LogAndList;
use App\Contracts\Services\LogAndList\CommentsServiceInterface as LogAndListCommentsServiceInterface;
use App\Contracts\Repositories\LogAndList\CommentsRepositoryInterface as LogAndListCommentsRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CommentsService implements LogAndListCommentsServiceInterface
{
    /**
     * @var LogAndListCommentsRepositoryInterface
     */
    protected $logAndListCommentsRepositoryInterface;

    /**
     * Create a new class instance.
     */
    public function __construct(LogAndListCommentsRepositoryInterface $logAndListCommentsRepositoryInterface)
    {
        $this->logAndListCommentsRepositoryInterface = $logAndListCommentsRepositoryInterface;
    }

    /**
     * Get all comments.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->logAndListCommentsRepositoryInterface->index();
    }
    
    /**
     * Get a comment by ID.
     *
     * @param  int  $id
     * @return \App\Models\LogAndList\Comments
     */
    public function show($id)
    {
        return $this->logAndListCommentsRepositoryInterface->show($id);
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
        return $this->logAndListCommentsRepositoryInterface->update($request, $id);
    }

    /**
     * Delete a comment.
     *
     * @param  int  $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->logAndListCommentsRepositoryInterface->destroy($id);
    }

    /**
     * Restore a soft-deleted comment.
     *
     * @param  int  $id
     * @return bool
     */
    public function restore($id)
    {
        return $this->logAndListCommentsRepositoryInterface->restore($id);
    }

    /**
     * Force delete a comment.
     *
     * @param  int  $id
     * @return bool
     */
    public function forceDelete($id)
    {
        return $this->logAndListCommentsRepositoryInterface->forceDelete($id);
    }

    /**
     * Post a new comment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function postComment($request)
    {
        return $this->logAndListCommentsRepositoryInterface->storeComment($request);
    }
    
    /**
     * Get all comments for a specific page ID.
     *
     * @param  int  $pageId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCommentsByPageId($pageId)
    {
        return $this->logAndListCommentsRepositoryInterface->getCommentsByPageId($pageId);
    }
   
    /**
     * Get comments by page ID and parent ID.
     *
     * @param  int  $pageId
     * @param  int  $parentId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCommentsByPageIdAndParentId($pageId, $parentId)
    {
        return $this->logAndListCommentsRepositoryInterface->getCommentsByPageIdAndParentId($pageId, $parentId);
    }
}
