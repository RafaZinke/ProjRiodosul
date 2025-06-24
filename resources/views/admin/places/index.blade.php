@extends('layouts.app')

@section('title', 'Admin | Locais')

@section('content')
<h1 class="text-2xl font-bold mb-4">Gerenciar Locais</h1>
<a href="{{ route('places.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Novo Local</a>
<table class="w-full mt-4 table-auto">
    <thead>
        <tr><th>Nome</th><th>Ações</th></tr>
    </thead>
    <tbody>
    @foreach($places as $place)
        <tr>
            <td>{{ $place->name }}</td>
            <td>
                <a href="{{ route('places.edit', $place) }}" class="text-yellow-600">Editar</a>
                <form action="{{ route('places.destroy', $place) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600 ml-2">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
