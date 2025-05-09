<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\page\DashboardController;
use App\Http\Controllers\page\LogAndListController;
use App\Http\Controllers\page\KJKPortfolioController;

Route::get('/', function () {return Inertia::render('Welcome');})->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('dashboard', DashboardController::class)->only('index');
Route::resource('kjkportfolio', KJKPortfolioController::class)->only('index');
Route::resource('logandlist', LogAndListController::class)->only('index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
