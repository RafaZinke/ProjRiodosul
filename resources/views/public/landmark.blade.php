{{-- File: resources/views/public/landmark.blade.php --}}
@extends('layouts.app')

@section('title', $landmark->name)

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $landmark->name }}</h1>

    {{-- Descrição e Endereço --}}
    <p>{{ $landmark->description }}</p>
    <p><strong>Endereço:</strong> {{ $landmark->address }}</p>

    {{-- Carrossel de Fotos --}}
    @if($landmark->photos->count())
    <div id="carouselPhotos" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($landmark->photos as $photo)
                <div class="carousel-item @if($loop->first) active @endif">
                    <img 
                        src="{{ asset($photo->url) }}" 
                        class="d-block w-100"
                        alt="{{ $photo->caption ?? $landmark->name }}"
                        style="max-height: 500px; object-fit: cover;"
                    >
                    @if($photo->caption)
                        <div class="carousel-caption d-none d-md-block">
                            <p>{{ $photo->caption }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button"
                data-bs-target="#carouselPhotos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button"
                data-bs-target="#carouselPhotos" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    @endif

    {{-- Abas: Eventos / Avaliações / Comentários --}}
    <ul class="nav nav-tabs mb-4" id="landmarkTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="events-tab" data-bs-toggle="tab"
                data-bs-target="#events" type="button" role="tab">
          Eventos ({{ $landmark->events->count() }})
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                data-bs-target="#reviews" type="button" role="tab">
          Avaliações ({{ $landmark->evaluations->count() }})
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="comments-tab" data-bs-toggle="tab"
                data-bs-target="#comments" type="button" role="tab">
          Comentários ({{ $landmark->comments->count() }})
        </button>
      </li>
    </ul>

    <div class="tab-content" id="landmarkTabsContent">
      {{-- Aba Eventos --}}
      <div class="tab-pane fade show active" id="events" role="tabpanel">
        @if($landmark->events->isEmpty())
          <p class="text-muted">Nenhum evento cadastrado para este marco.</p>
        @else
          <div class="list-group mb-4">
            @foreach($landmark->events as $event)
              <a href="{{ route('event.show', $event) }}"
                 class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{ $event->title }}</h5>
                  <small>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</small>
                </div>
                <p class="mb-1">
                  {{ \Illuminate\Support\Str::limit($event->description, 100) }}
                </p>
              </a>
            @endforeach
          </div>
        @endif
      </div>

      {{-- Aba Avaliações --}}
      <div class="tab-pane fade" id="reviews" role="tabpanel">
        <h3>Média: {{ round($landmark->evaluations->avg('rating'), 1) }} / 5</h3>
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
      </div>

      {{-- Aba Comentários --}}
      <div class="tab-pane fade" id="comments" role="tabpanel">
        @foreach($landmark->comments as $comment)
            <div class="mb-3 border-bottom pb-2">
                <p>{{ $comment->content }}</p>
                <small class="text-muted">
                  por {{ $comment->user ? $comment->user->name : 'Anônimo' }}
                  em {{ $comment->created_at->format('d/m/Y H:i') }}
                </small>
            </div>
        @endforeach

        <form action="{{ route('comment.store') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="landmark_id" value="{{ $landmark->id }}">
            <div class="mb-3">
                <label for="content" class="form-label">Deixe um comentário</label>
                <textarea name="content" id="content" rows="3"
                          class="form-control"></textarea>
            </div>
            <button class="btn btn-primary">Enviar</button>
        </form>
      </div>
    </div>
</div>
@endsection
