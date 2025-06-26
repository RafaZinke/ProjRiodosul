<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Exibe a página de detalhes de um evento.
     */
    public function show(Event $event)
    {
        // Carrega o marco associado (e, se necessário, comentários/avaliações do evento)
        $event->load('landmark');

        return view('public.event', compact('event'));
    }
}
