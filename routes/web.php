<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\LandmarkController;
use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\Public\CommentController;
use App\Http\Controllers\Public\EvaluationController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandmarkController::class, 'index'])->name('home');
Route::view('/map', 'public.map')->name('map');
Route::get('/landmark/{landmark}', [LandmarkController::class, 'show'])->name('landmark.show');
Route::get('/event/{event}', [EventController::class, 'show'])->name('event.show');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::post('/evaluation', [EvaluationController::class, 'store'])->name('evaluation.store');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/admin.php';
