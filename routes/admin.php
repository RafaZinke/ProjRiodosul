<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LandmarkController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
| Prefixo URI: /admin
| Middleware: auth + can:admin
| Nome de rota: admin.*
|
*/

Route::middleware(['auth'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         // Dashboard
         Route::get('/dashboard', [DashboardController::class, 'index'])
              ->name('dashboard');

         // CRUD de Marcos
         Route::resource('landmarks', LandmarkController::class)
              ->except(['show']);

         // CRUD de Eventos
         Route::resource('events', EventController::class)
              ->except(['show']);

         // Moderação de Comentários
         Route::resource('comments', CommentController::class)
              ->only(['index', 'destroy']);

         // Gerenciamento de Usuários
         Route::resource('users', UserController::class)
              ->only(['index', 'destroy']);
     });
