@extends('layouts.admin')

@section('title', 'Editar Evento')

@section('content')
    <h1>Editar Evento</h1>
    <form action="{{ route('admin.events.update', $event) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Marco</label>
            <select name="landmark_id" class="form-select" required>
                @foreach($landmarks as $id => $name)
                    <option value="{{ $id }}" {{ old('landmark_id', $event->landmark_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description', $event->description) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Data do Evento</label>
            <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $event->event_date->toDateString()) }}" required>
        </div>

        <button class="btn btn-success">Atualizar</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
