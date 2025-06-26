<?php
// File: app/Http/Controllers/Public/EvaluationController.php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationRequest;
use App\Models\Evaluation;
use Illuminate\Http\RedirectResponse;

class EvaluationController extends Controller
{
    /**
     * Armazena uma avaliação enviada pelo visitante (anon ou logado).
     *
     * @param  StoreEvaluationRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreEvaluationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->check() ? auth()->id() : null;

        Evaluation::create($data);

        return redirect()
            ->route('landmark.show', $request->landmark_id)
            ->with('success', 'Avaliação registrada com sucesso!');
    }
}
