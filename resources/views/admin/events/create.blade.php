@extends('layouts.app')

@section('title', 'Admin | Novo Evento')

@section('content')
<h1 class="text-2xl font-bold mb-4">Criar Evento</h1>
<form action="{{ route('events.store') }}" method="POST">
    @csrf
    <div class="space-y-4">
        <div>
            <label>Local</label>
            <select name="place_id" class="w-full border p-2">
                @foreach($places as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Título</label>
            <input type="text" name="title" class="w-full border p-2">
        </div>
        <div>
            <label>Data</label>
            <input type="date" name="event_date" class="w-full border p-2">
        </div>
        <div>
            <label>Descrição</label>
            <textarea name="description" class="w-full border p-2"></textarea>
        </div>
    </div>
    <button type="submit" class="bg-green-600 text-white px-3 py-1 mt-4">Salvar</button>
</form>
@endsection
