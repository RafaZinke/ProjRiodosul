<?php

namespace App\Http\Controllers\Admin;  // <-- aqui

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Lista os comentários para moderação (index).
     * Se não quiser index em admin, remova este método.
     */
    public function index()
    {
        $comments = Comment::with('user', 'landmark')->paginate(25);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove um comentário (destroy).
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comentário removido com sucesso!');
    }

    /**
     * (Opcional) Caso queira reusar o store aqui, mas geralmente
     * comentários públicos vão em Public\CommentController.
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->check() ? auth()->id() : null;
        Comment::create($data);

        return redirect()->route('landmark.show', $request->landmark_id)
                         ->with('success', 'Comentário enviado com sucesso!');
    }
}
