<?php
use Illuminate\Support\Facades\Route;

// logandlist
use App\Http\Controllers\LogAndList\PathNotesController as LogAndListPathNotesController;
use App\Http\Controllers\LogAndList\CommentsController as LogAndListCommentsController;

/**
 * logandlist
 */
Route::group(['prefix' => 'logandlist', 'as' => 'logandlist.'], function () {

    Route::get('get-all-path-note', [LogAndListPathNotesController::class, 'getAllPathNote'])
        ->name('get-all-path-note.getAllPathNote');

    Route::get('get-path-note/{id}', [LogAndListPathNotesController::class, 'getPathNote'])
        ->name('get-path-note.getPathNote');

    Route::get('get-comment-list/{pageId}', [LogAndListCommentsController::class, 'getCommentsByPageId'])
        ->name('get-comment-list.getCommentsByPageId');

    Route::post('post-comment', [LogAndListCommentsController::class, 'postComment'])
        ->name('post-comment.postComment');
    
});