<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Place;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('place')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $places = Place::all();
        return view('admin.events.create', compact('places'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'place_id'    => 'required|exists:places,id',
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
        ]);

        Event::create($data);
        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento criado.');
    }

    public function edit(Event $event)
    {
        $places = Place::all();
        return view('admin.events.edit', compact('event', 'places'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'place_id'    => 'required|exists:places,id',
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
        ]);

        $event->update($data);
        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento atualizado.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('success', 'Evento removido.');
    }
}
