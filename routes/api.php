<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MapController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| As rotas abaixo já recebem automaticamente prefixo `/api` e middleware
| `api` via o RouteServiceProvider. Aqui você define os endpoints da API:
|
|   GET  /api/map    → retorna JSON com todos os marcos para exibir no mapa
|
*/

Route::get('/map', [MapController::class, 'index'])
     ->name('api.map');
