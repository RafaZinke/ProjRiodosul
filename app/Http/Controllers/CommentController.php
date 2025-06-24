<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'place_id'  => 'required|exists:places,id',
            'content'   => 'required|string',
            'anonymous' => 'nullable|boolean',
        ]);

        // Se o usuário estiver logado, associe; senão null
        $data['user_id'] = Auth::check() ? Auth::id() : null;
        $data['anonymous'] = $request->has('anonymous');

        Comment::create($data);

        return back()->with('success', 'Comentário enviado.');
    }
}
