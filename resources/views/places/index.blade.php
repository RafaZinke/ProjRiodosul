@extends('layouts.app')

@section('title', 'Locais de Rio do Sul')

@section('content')
<h1 class="text-2xl font-bold mb-4">Locais Históricos e Turísticos</h1>
<div class="grid grid-cols-3 gap-4">
    @foreach($places as $place)
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold">{{ $place->name }}</h2>
            <p>{{ Str::limit($place->description, 100) }}</p>
            @if($place->images->first())
                <img src="{{ $place->images->first()->url }}" alt="" class="mt-2 h-32 w-full object-cover rounded">
            @endif
            <a href="{{ route('places.show', $place) }}" class="text-blue-600 mt-2 inline-block">Ver detalhes</a>
        </div>
    @endforeach
</div>
@endsection
