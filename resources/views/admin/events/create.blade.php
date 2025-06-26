@extends('layouts.admin')

@section('title', 'Novo Evento')
@section('content')
  <h1>Novo Evento</h1>

  <form action="{{ route('admin.events.store') }}" method="POST">
    @csrf

    {{-- Landmark --}}
    <div class="mb-3">
      <label for="landmark_id" class="form-label">Marco Histórico</label>
      <select 
        name="landmark_id" 
        id="landmark_id" 
        class="form-select @error('landmark_id') is-invalid @enderror"
        required
      >
        <option value="" disabled selected>Selecione um marco...</option>
        @foreach($landmarks as $id => $name)
          <option value="{{ $id }}">{{ $name }}</option>
        @endforeach
      </select>
      @error('landmark_id')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Title --}}
    <div class="mb-3">
      <label for="title" class="form-label">Título</label>
      <input 
        type="text" 
        name="title" 
        id="title" 
        class="form-control @error('title') is-invalid @enderror" 
        value="{{ old('title') }}" 
        required
      >
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Description --}}
    <div class="mb-3">
      <label for="description" class="form-label">Descrição</label>
      <textarea 
        name="description" 
        id="description" 
        rows="3" 
        class="form-control @error('description') is-invalid @enderror"
        required
      >{{ old('description') }}</textarea>
      @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- Date --}}
    <div class="mb-3">
      <label for="event_date" class="form-label">Data do Evento</label>
      <input
        type="date"
        name="event_date"
        id="event_date"
        class="form-control @error('event_date') is-invalid @enderror"
        value="{{ old('event_date') }}"
        required
      >
      @error('event_date')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
@endsection
