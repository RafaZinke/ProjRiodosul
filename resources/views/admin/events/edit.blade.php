@extends('layouts.app')

@section('title', 'Admin | Editar Evento')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Evento</h1>
<form action="{{ route('events.update', $event) }}" method="POST">
    @csrf @method('PUT')
    <div class="space-y-4">
        <div>
            <label>Local</label>
            <select name="place_id" class="w-full border p-2">
                @foreach($places as $p)
                    <option value="{{ $p->id }}" {{ $event->place_id == $p->id ? 'selected' : '' }}>
                        {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Título</label>
            <input type="text" name="title" value="{{ old('title', $event->title) }}"
                   class="w-full border p-2">
        </div>
        <div>
            <label>Data</label>
            <input type="date" name="event_date" value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}"
                   class="w-full border p-2">
        </div>
        <div>
            <label>Descrição</label>
            <textarea name="description" class="w-full border p-2">{{ old('description', $event->description) }}</textarea>
        </div>
    </div>
    <button type="submit" class="bg-green-600 text-white px-3 py-1 mt-4">Atualizar</button>
</form>
@endsection
