<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Visitantes)
|--------------------------------------------------------------------------
*/
Route::get('/', [PlaceController::class, 'index'])
     ->name('places.index');

Route::get('/places/{id}', [PlaceController::class, 'show'])
     ->name('places.show');

Route::post('/comment', [CommentController::class, 'store'])
     ->name('comment.store');

Route::post('/rating', [RatingController::class, 'store'])
     ->name('rating.store');

/*
|--------------------------------------------------------------------------
| Rotas de Admin (CRUD) — acessíveis apenas com auth + middleware 'admin'
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
     ->middleware(['auth', 'admin'])
     ->group(function () {
         // Locais
         Route::resource('places', AdminPlaceController::class)
              ->names([
                  'index'   => 'admin.places.index',
                  'create'  => 'admin.places.create',
                  'store'   => 'admin.places.store',
                  'show'    => 'admin.places.show',
                  'edit'    => 'admin.places.edit',
                  'update'  => 'admin.places.update',
                  'destroy' => 'admin.places.destroy',
              ]);

         // Eventos
         Route::resource('events', AdminEventController::class)
              ->names([
                  'index'   => 'admin.events.index',
                  'create'  => 'admin.events.create',
                  'store'   => 'admin.events.store',
                  'show'    => 'admin.events.show',
                  'edit'    => 'admin.events.edit',
                  'update'  => 'admin.events.update',
                  'destroy' => 'admin.events.destroy',
              ]);
     });
