<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Landmark;
use Illuminate\Http\JsonResponse;

class MapController extends Controller
{
    /**
     * Retorna JSON com todos os marcos históricos,
     * incluindo id, nome e coordenadas para o mapa.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $landmarks = Landmark::select(['id', 'name', 'latitude', 'longitude'])->get();
        return response()->json($landmarks);
    }
}