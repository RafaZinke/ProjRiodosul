{{-- File: resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Usuários')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Usuários</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Admin?</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_admin)
                            <span class="badge bg-success">Sim</span>
                        @else
                            <span class="badge bg-secondary">Não</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form 
                            action="{{ route('admin.users.destroy', $user) }}" 
                            method="POST" 
                            onsubmit="return confirm('Tem certeza que deseja remover este usuário?');"
                        >
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginação --}}
    <div class="mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
