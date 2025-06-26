<?php
// File: app/Http/Controllers/Public/CommentController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Armazena um comentário enviado pelo visitante (anon ou logado).
     *
     * @param  StoreCommentRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->check() ? auth()->id() : null;

        Comment::create($data);

        return redirect()
            ->route('landmark.show', $request->landmark_id)
            ->with('success', 'Comentário enviado com sucesso!');
    }
}
