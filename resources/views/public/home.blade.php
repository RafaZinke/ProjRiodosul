{{-- File: resources/views/public/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Bem-vindo ao ProjRioDoSul')

@section('content')
    {{-- Botão Painel Admin sempre visível --}}
    <div class="mb-4 text-end">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            Painel Admin
        </a>
    </div>

    <div class="row g-4">
        @foreach($landmarks as $landmark)
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    {{-- Thumbnail reduzida --}}
                    @if($landmark->photos->count())
                        <img 
                            src="{{ asset($landmark->photos->first()->url) }}" 
                            class="card-img-top"
                            alt="{{ $landmark->name }}"
                            style="height:150px; object-fit:cover;"
                        >
                    @else
                        <img 
                            src="{{ asset('images/placeholder.png') }}" 
                            class="card-img-top" 
                            alt="Sem imagem disponível"
                            style="height:150px; object-fit:cover;"
                        >
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $landmark->name }}</h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($landmark->description, 100) }}
                        </p>
                        <a href="{{ route('landmark.show', $landmark) }}" class="btn btn-primary mt-auto">
                            Ver detalhes
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $landmarks->links('pagination::bootstrap-5') }}
    </div>
@endsection
