<?php

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashBoard\DimensionsDataController as DashBoardDimensionsDataController;
use App\Http\Controllers\KJKPortfolio\DimensionsDataController as KJKPortfolioMetricsDataController;
use App\Http\Controllers\LogAndList\DimensionsDataController as LogAndListDimensionsDataController;
use App\Http\Controllers\LogAndList\CommentsController as LogAndListCommentsController;


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
});


// Route::get('dashboard-dimensions-data', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard-dimensions-data');