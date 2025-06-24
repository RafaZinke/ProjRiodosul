<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        return view('admin.places.create');
    }

    public function store(Request $request)
    {
        // validação
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'required|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        Place::create($data);
        return redirect()->route('admin.places.index')
                         ->with('success', 'Local criado com sucesso.');
    }

    public function edit(Place $place)
    {
        return view('admin.places.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'required|string',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        $place->update($data);
        return redirect()->route('admin.places.index')
                         ->with('success', 'Local atualizado com sucesso.');
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return back()->with('success', 'Local removido.');
    }
}
