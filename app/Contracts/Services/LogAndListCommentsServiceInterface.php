<?php

namespace App\Contracts\Services;

interface LogAndListCommentsServiceInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request, $id);
    public function destroy($id);
    public function restore($id);
    public function forceDelete($id);
    public function getCommentsByPageId($pageId);
    public function getCommentsByPageIdAndParentId($pageId, $parentId);
}
