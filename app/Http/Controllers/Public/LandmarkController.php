<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Landmark;

class LandmarkController extends Controller
{
    /**
     * Exibe a listagem de marcos na página inicial.
     */
    public function index()
    {
        // Carrega marcos com as fotos e paginação
        $landmarks = Landmark::with('photos')->paginate(9);

        return view('public.home', compact('landmarks'));
    }

    /**
     * Exibe detalhes de um único marco.
     */
    public function show(Landmark $landmark)
    {
        // Carrega relacionamentos necessários
        $landmark->load(['photos', 'comments.user', 'evaluations']);

        return view('public.landmark', compact('landmark'));
    }
}
