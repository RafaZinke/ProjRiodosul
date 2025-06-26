<?php
// File: app/Http/Requests/StoreCommentRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Qualquer visitante (anon ou auth) pode enviar comentário
        return true;
    }

    public function rules(): array
    {
        return [
            'landmark_id' => ['required', 'exists:landmarks,id'],
            'content'     => ['required', 'string', 'max:1000'],
        ];
    }
}
