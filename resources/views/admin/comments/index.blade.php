{{-- File: resources/views/admin/comments/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Comentários')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Comentários</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Conteúdo</th>
                <th>Autor</th>
                <th>Marco</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ \Illuminate\Support\Str::limit($comment->content, 50) }}</td>
                    <td>{{ $comment->user ? $comment->user->name : 'Anônimo' }}</td>
                    <td>{{ $comment->landmark->name }}</td>
                    <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.comments.destroy', $comment) }}"
                              method="POST"
                              onsubmit="return confirm('Tem certeza que deseja apagar este comentário?');">
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
        {{ $comments->links() }}
    </div>
@endsection
