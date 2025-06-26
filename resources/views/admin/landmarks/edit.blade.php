@extends('layouts.admin')

@section('title', 'Editar Marco')

@section('content')
    <h1>Editar Marco</h1>
    <form action="{{ route('admin.landmarks.update', $landmark) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- Campos idênticos ao create, mas populados --}}
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $landmark->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description', $landmark->description) }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control" value="{{ old('latitude', $landmark->latitude) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control" value="{{ old('longitude', $landmark->longitude) }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $landmark->address) }}" required>
            </div>
        </div>

        {{-- Fotos já existentes --}}
        @if($landmark->photos->count())
            <div class="mb-3">
                <label class="form-label">Fotos Atuais</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($landmark->photos as $photo)
                        <img src="{{ asset('storage/'.$photo->url) }}" width="100" class="border">
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-3">
            <label class="form-label">Novas Imagens (upload múltiplo)</label>
            <input type="file" name="photos[]" class="form-control" multiple>
        </div>
        <div class="mb-3">
            <label class="form-label">Adicionar URLs de Imagens</label>
            <textarea name="photo_urls[]" class="form-control" placeholder="http://..."></textarea>
        </div>

        <button class="btn btn-success">Atualizar</button>
        <a href="{{ route('admin.landmarks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
