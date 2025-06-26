{{-- File: resources/views/public/event.blade.php --}}
@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $event->title }}</h1>

    {{-- Data e Marco --}}
    <p>
      <strong>Data:</strong>
      {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}
    </p>
    <p>
      <strong>Local:</strong>
      <a href="{{ route('landmark.show', $event->landmark) }}">
        {{ $event->landmark->name }}
      </a>
    </p>

    {{-- Descrição completa --}}
    <div class="mb-4">
      {!! nl2br(e($event->description)) !!}
    </div>

    {{-- Se quiser comentários ou avaliações específicas do evento, adicione aqui --}}
</div>
@endsection
