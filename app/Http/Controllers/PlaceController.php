<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    // Lista todos os locais
    public function index()
    {
        $places = Place::with('images')->get();
        return view('places.index', compact('places'));
    }

    // Detalha um local específico
    public function show($id)
    {
        $place = Place::with(['events', 'comments.user', 'ratings', 'images'])
                      ->findOrFail($id);
        return view('places.show', compact('place'));
    }
}
