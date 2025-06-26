@extends('layouts.app')

@section('title', $event->title)

@section('content')
<h1>{{ $event->title }}</h1>
<p><strong>Data:</strong> {{ $event->event_date->format('d/m/Y') }}</p>
<p>{{ $event->description }}</p>
<a href="{{ route('landmark.show', $event->landmark) }}" class="btn btn-secondary">Voltar ao Marco</a>
@endsection