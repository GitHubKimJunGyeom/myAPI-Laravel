<?php

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// dashboard
use App\Http\Controllers\DashBoard\DimensionsDataController as DashBoardDimensionsDataController;

// kjkportfolio
use App\Http\Controllers\KJKPortfolio\DimensionsDataController as KJKPortfolioMetricsDataController;

// logandlist
use App\Http\Controllers\LogAndList\DimensionsDataController as LogAndListDimensionsDataController;
use App\Http\Controllers\LogAndList\CommentsController as LogAndListCommentsController;
use App\Http\Controllers\LogAndList\PathNotesController as LogAndListPathNotesController;

// welcome page
Route::get('/', function () {return Inertia::render('Welcome');})->name('home');

/**
 * dashboard
 */
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::resource('dimensions-data', DashBoardDimensionsDataController::class)->only('index');
});

/**
 * kjkportfolio
 */
Route::group(['prefix' => 'kjkportfolio', 'as' => 'kjkportfolio.'], function () {
    Route::resource('metrics-data', KJKPortfolioMetricsDataController::class)->only('index');
});

/**
 * logandlist
 */
Route::group(['prefix' => 'logandlist', 'as' => 'logandlist.'], function () {
    Route::resource('metrics-data', LogAndListDimensionsDataController::class)->only('index');
    Route::resource('comments-data', LogAndListCommentsController::class)->only('index');

    // index는 공개
    Route::get('path-notes-data', [LogAndListPathNotesController::class, 'index'])
        ->name('path-notes-data.index');

    // show는 공개
    Route::get('path-notes-data/{id}', [LogAndListPathNotesController::class, 'show'])
        ->whereNumber('id')
        ->name('path-notes-data.show');

    // 나머지 액션만 인증 필요
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('path-notes-data/create', [LogAndListPathNotesController::class, 'create'])->name('path-notes-data.create');
        Route::post('path-notes-data', [LogAndListPathNotesController::class, 'store'])->name('path-notes-data.store');
        Route::get('path-notes-data/{id}/edit', [LogAndListPathNotesController::class, 'edit'])->name('path-notes-data.edit');
        Route::put('path-notes-data/{id}', [LogAndListPathNotesController::class, 'update'])->name('path-notes-data.update');
        Route::delete('path-notes-data/{id}', [LogAndListPathNotesController::class, 'destroy'])->name('path-notes-data.destroy');
    });
});


// Route::get('dashboard-dimensions-data', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard-dimensions-data');