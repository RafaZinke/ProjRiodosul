@extends('layouts.admin')

@section('title', 'Marcos')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h1>Marcos Históricos</h1>
        <a href="{{ route('admin.landmarks.create') }}" class="btn btn-primary">Novo Marco</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Eventos</th>
                <th>Comentários</th>
                <th>Avaliações</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($landmarks as $lm)
            <tr>
                <td>{{ $lm->id }}</td>
                <td>{{ $lm->name }}</td>
                <td>{{ $lm->events_count }}</td>
                <td>{{ $lm->comments_count }}</td>
                <td>{{ $lm->evaluations_count }}</td>
                <td>
                    <a href="{{ route('admin.landmarks.edit', $lm) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('admin.landmarks.destroy', $lm) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Deseja realmente excluir?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $landmarks->links() }}
@endsection
