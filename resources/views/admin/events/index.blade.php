@extends('layouts.app')

@section('title', 'Admin | Eventos')

@section('content')
<h1 class="text-2xl font-bold mb-4">Gerenciar Eventos</h1>
<a href="{{ route('events.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Novo Evento</a>
<table class="w-full mt-4 table-auto">
    <thead>
        <tr><th>Local</th><th>Título</th><th>Data</th><th>Ações</th></tr>
    </thead>
    <tbody>
    @foreach($events as $event)
        <tr>
            <td>{{ $event->place->name }}</td>
            <td>{{ $event->title }}</td>
            <td>{{ $event->event_date->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('events.edit', $event) }}" class="text-yellow-600">Editar</a>
                <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600 ml-2">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
