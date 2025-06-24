@extends('layouts.app')

@section('title', 'Admin | Editar Local')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Local</h1>
<form action="{{ route('places.update', $place) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.places._form')
    <button type="submit" class="bg-green-600 text-white px-3 py-1">Atualizar</button>
</form>
@endsection
