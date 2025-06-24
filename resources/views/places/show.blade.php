@extends('layouts.app')

@section('title', $place->name)

@section('content')
<h1 class="text-2xl font-bold">{{ $place->name }}</h1>
<p class="mt-2">{{ $place->description }}</p>

<div id="map" class="h-64 my-4"></div>

<h2 class="text-xl font-semibold mt-6">Galeria</h2>
<div class="flex space-x-2 overflow-x-auto">
    @foreach($place->images as $img)
        <img src="{{ $img->url }}" class="h-32 rounded" alt="">
    @endforeach
</div>

<h2 class="text-xl font-semibold mt-6">Avaliação Média: {{ $place->averageRating() ?? '—' }}</h2>

<form action="{{ route('rating.store') }}" method="POST" class="mt-2">
    @csrf
    <input type="hidden" name="place_id" value="{{ $place->id }}">
    <label>Avalie de 1 a 5:</label>
    <select name="score" class="border p-1">
        @for($i=1; $i<=5; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
    <button type="submit" class="bg-blue-600 text-white px-3 py-1">Enviar</button>
</form>

<h2 class="text-xl font-semibold mt-6">Comentários</h2>
@foreach($place->comments as $comment)
    <div class="border p-2 my-2 rounded">
        <strong>{{ $comment->anonymous ? 'Anônimo' : ($comment->user->name ?? 'Visitante') }}:</strong>
        <p>{{ $comment->content }}</p>
        <small class="text-gray-500">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
    </div>
@endforeach

<form action="{{ route('comment.store') }}" method="POST" class="mt-4">
    @csrf
    <input type="hidden" name="place_id" value="{{ $place->id }}">
    <textarea name="content" rows="3" class="w-full border p-2" placeholder="Seu comentário"></textarea>
    <label class="inline-flex items-center mt-2">
        <input type="checkbox" name="anonymous" class="mr-2"> Comentar anonimamente
    </label>
    <button type="submit" class="bg-green-600 text-white px-3 py-1 mt-2">Comentar</button>
</form>

@push('scripts')
<script>
  function initMap() {
    const loc = { lat: {{ $place->latitude }}, lng: {{ $place->longitude }} };
    const map = new google.maps.Map(document.getElementById('map'), { zoom: 15, center: loc });
    new google.maps.Marker({ position: loc, map });
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
@endpush
@endsection
