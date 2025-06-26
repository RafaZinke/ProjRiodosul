@extends('layouts.admin')

@section('title', 'Novo Evento')

@section('content')
    <h1>Novo Evento</h1>
    <form action="{{ route('admin.events.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Marco</label>
            <select name="landmark_id" class="form-select" required>
                <option value=\"\">-- escolha um marco --</option>
                @foreach($landmarks as $id => $name)
                    <option value=\"{{ $id }}\" {{ old('landmark_id') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Data do Evento</label>
            <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" required>
        </div>

        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
