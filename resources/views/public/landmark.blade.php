{{-- File: resources/views/public/landmark.blade.php --}}
@extends('layouts.app')

@section('title', $landmark->name)

@section('content')
<h1>{{ $landmark->name }}</h1>
<p>{{ $landmark->description }}</p>
<p><strong>Endereço:</strong> {{ $landmark->address }}</p>

@if($landmark->photos->count())
<div id="carouselPhotos" class="carousel slide mb-4" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($landmark->photos as $photo)
            <div class="carousel-item @if($loop->first) active @endif">
                <img src="{{ $photo->url }}" class="d-block w-100" alt="{{ $photo->caption }}">
                @if($photo->caption)
                    <div class="carousel-caption d-none d-md-block">
                        <p>{{ $photo->caption }}</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPhotos" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselPhotos" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
@endif

<h3>Avaliações</h3>
<p>Média: {{ round($landmark->evaluations->avg('rating'), 1) }} / 5</p>
<form action="{{ route('evaluation.store') }}" method="POST" class="mb-4">
    @csrf
    <input type="hidden" name="landmark_id" value="{{ $landmark->id }}">
    <div class="mb-3">
        <label for="rating" class="form-label">Nota (1 a 5)</label>
        <select name="rating" id="rating" class="form-select">
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <button class="btn btn-success">Avaliar</button>
</form>

<h3>Comentários</h3>
@foreach($landmark->comments as $comment)
    <div class="mb-3">
        <p>{{ $comment->content }}</p>
        <small class="text-muted">por {{ $comment->user ? $comment->user->name : 'Anônimo' }}</small>
    </div>
@endforeach
<form action="{{ route('comment.store') }}" method="POST">
    @csrf
    <input type="hidden" name="landmark_id" value="{{ $landmark->id }}">
    <div class="mb-3">
        <label for="content" class="form-label">Deixe um comentário</label>
        <textarea name="content" id="content" rows="3" class="form-control"></textarea>
    </div>
    <button class="btn btn-primary">Enviar</button>
</form>
@endsection
