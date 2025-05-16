<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashBoard\DimensionsDataController as DashBoardDimensionsDataController;
use App\Http\Controllers\KJKPortfolio\DimensionsDataController as KJKPortfolioMetricsDataController;
use App\Http\Controllers\LogAndList\DimensionsDataController as LogAndListDimensionsDataController;

Route::get('/', function () {return Inertia::render('Welcome');})->name('home');

// Route::get('dashboard-dimensions-data', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard-dimensions-data');

Route::resource('dashboard-dimensions-data', DashBoardDimensionsDataController::class)->only('index');
Route::resource('kjkportfolio-metrics-data', KJKPortfolioMetricsDataController::class)->only('index');
Route::resource('logandlist-metrics-data', LogAndListDimensionsDataController::class)->only('index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
