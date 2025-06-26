<?php
// File: app/Http/Controllers/Admin/EventController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Models\Landmark;  // <— import adicionado

class EventController extends Controller
{
    /**
     * Exibe a lista de eventos no painel Admin.
     */
    public function index()
    {
        $events = Event::with('landmark')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Exibe o formulário de criação de um novo evento.
     */
    public function create()
    {
        // Busca todos os marcos para popular o select
        $landmarks = Landmark::pluck('name', 'id');
        return view('admin.events.create', compact('landmarks'));
    }

    /**
     * Valida e armazena um novo evento.
     */
    public function store(StoreEventRequest $request)
    {
        Event::create($request->validated());
        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição de um evento existente.
     */
    public function edit(Event $event)
    {
        $landmarks = Landmark::pluck('name', 'id');
        return view('admin.events.edit', compact('event', 'landmarks'));
    }

    /**
     * Valida e atualiza um evento existente.
     */
    public function update(StoreEventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove um evento.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')
                         ->with('success', 'Evento removido com sucesso!');
    }
}
