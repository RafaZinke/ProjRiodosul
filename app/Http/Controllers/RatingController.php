<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'place_id' => 'required|exists:places,id',
            'score'    => 'required|integer|min:1|max:5',
        ]);

        $userId = Auth::check() ? Auth::id() : null;

        // Atualiza caso o mesmo usuário já tenha avaliado
        Rating::updateOrCreate(
            ['place_id' => $data['place_id'], 'user_id' => $userId],
            ['score' => $data['score']]
        );

        return back()->with('success', 'Avaliação registrada.');
    }
}
