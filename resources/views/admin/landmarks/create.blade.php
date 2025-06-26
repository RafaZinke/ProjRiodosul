@extends('layouts.admin')

@section('title', 'Novo Marco')

@section('content')
    <h1>Novo Marco</h1>
    <form action="{{ route('admin.landmarks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}" required>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Endereço</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagens (upload múltiplo)</label>
            <input type="file" name="photos[]" class="form-control" multiple>
        </div>
        <div class="mb-3">
            <label class="form-label">URLs de Imagens (opcional)</label>
            <textarea name="photo_urls[]" class="form-control" placeholder="http://..."></textarea>
        </div>

        <button class="btn btn-success">Salvar</button>
        <a href="{{ route('admin.landmarks.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
