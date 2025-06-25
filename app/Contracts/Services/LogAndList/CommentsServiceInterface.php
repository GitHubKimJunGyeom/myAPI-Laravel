<?php

namespace App\Contracts\Services\LogAndList;

interface CommentsServiceInterface
{
    public function index();
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
    public function restore($id);
    public function forceDelete($id);

    // API methods
    public function postComment($request);
    public function getCommentsByPageId(string $pageId);
    public function getCommentsByPageIdAndParentId($pageId, $parentId);
}
