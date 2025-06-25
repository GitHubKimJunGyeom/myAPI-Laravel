<?php

namespace App\Contracts\Repositories\LogAndList;

interface CommentsRepositoryInterface
{
    public function index();
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
    public function restore($id);
    public function forceDelete($id);
 
    // API methods
    public function storeComment($request);
    public function updateComment($request, $id);
    public function getCommentsByPageId(string $pageId);
    public function getCommentsByPageIdAndParentId(string $pageId, int $parentId);
}
