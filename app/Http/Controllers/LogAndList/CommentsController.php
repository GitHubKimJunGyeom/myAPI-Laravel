<?php

namespace App\Http\Controllers\LogAndList;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LogAndList\CommentRequest;
use Inertia\Inertia;
use App\Contracts\Services\LogAndList\CommentsServiceInterface as LogAndListCommentsServiceInterface;
use App\Http\Resources\LogAndList\CommentResource as LogAndListCommentResource;
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


    //////////////////////////////////////////////////////////////////////////
    // ** API methods ** //
    //////////////////////////////////////////////////////////////////////////

    /**
     * Store a newly created resource in storage.
     */
    public function postComment(CommentRequest $request)
    {
        $comment = $this->logAndListCommentsServiceInterface->postComment($request);
        Log::info('Log&List Comment created', ['comment' => $comment]);
        return new LogAndListCommentResource($comment);
    }

    /**
     * Get all comments By PageId.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentsByPageId(string $pageId):Array
    {
        $comments = $this->logAndListCommentsServiceInterface->getCommentsByPageId($pageId);
        Log::info('Log&List Comments by Page ID', ['pageId' => $pageId, 'comments' => $comments]);
        return LogAndListCommentResource::collection($comments)->toArray(request());
    }

    /**
     * Get comments by page ID and parent ID.
     *
     * @param  string  $pageId
     * @param  int  $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCommentsByPageIdAndParentId($pageId, $parentId)
    {
        $comments = $this->logAndListCommentsServiceInterface->getCommentsByPageIdAndParentId($pageId, $parentId);
        return response()->json($comments);
    }
}
