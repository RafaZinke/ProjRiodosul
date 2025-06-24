@extends('layouts.app')

@section('title', 'Admin | Novo Local')

@section('content')
<h1 class="text-2xl font-bold mb-4">Criar Local</h1>
<form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.places._form')
    <button type="submit" class="bg-green-600 text-white px-3 py-1">Salvar</button>
</form>
@endsection
