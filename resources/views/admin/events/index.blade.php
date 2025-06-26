@extends('layouts.admin')

@section('title', 'Eventos')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Eventos</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Novo Evento</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marco</th>
                <th>Título</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $ev)
            <tr>
                <td>{{ $ev->id }}</td>
                <td>{{ $ev->landmark->name }}</td>
                <td>{{ $ev->title }}</td>
                <td>{{ $ev->event_date->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.events.edit', $ev) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.events.destroy', $ev) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Excluir este evento?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $events->links() }}
@endsection
