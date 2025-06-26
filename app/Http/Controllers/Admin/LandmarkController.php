<?php
// File: app/Http/Controllers/Admin/LandmarkController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandmarkRequest;
use App\Models\Landmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandmarkController extends Controller
{
    /**
     * Exibe a lista de marcos no painel Admin.
     */
    public function index()
    {
        $landmarks = Landmark::withCount(['events', 'comments', 'evaluations'])->paginate(15);
        return view('admin.landmarks.index', compact('landmarks'));
    }

    /**
     * Exibe o formulário para criar um novo marco.
     */
    public function create()
    {
        return view('admin.landmarks.create');
    }

    /**
     * Armazena um novo marco, processando upload de fotos e URLs.
     */
    public function store(StoreLandmarkRequest $request)
    {
        $data = $request->validated();
        $landmark = Landmark::create($data);

        // Upload de arquivos de imagem
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('images', 'public');
                $landmark->photos()->create([
                    'url'     => Storage::url($path),
                    'caption' => null,
                ]);
            }
        }

        // URLs de fotos, se fornecidas
        if ($request->filled('photo_urls')) {
            foreach ($request->input('photo_urls') as $url) {
                $landmark->photos()->create([
                    'url'     => $url,
                    'caption' => null,
                ]);
            }
        }

        return redirect()
            ->route('admin.landmarks.index')
            ->with('success', 'Marco histórico criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição para um marco existente.
     */
    public function edit(Landmark $landmark)
    {
        return view('admin.landmarks.edit', compact('landmark'));
    }

    /**
     * Atualiza um marco existente e adiciona fotos/URLs extras.
     */
    public function update(StoreLandmarkRequest $request, Landmark $landmark)
    {
        $data = $request->validated();
        $landmark->update($data);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('images', 'public');
                $landmark->photos()->create([
                    'url'     => Storage::url($path),
                    'caption' => null,
                ]);
            }
        }

        if ($request->filled('photo_urls')) {
            foreach ($request->input('photo_urls') as $url) {
                $landmark->photos()->create([
                    'url'     => $url,
                    'caption' => null,
                ]);
            }
        }

        return redirect()
            ->route('admin.landmarks.index')
            ->with('success', 'Marco histórico atualizado com sucesso!');
    }

    /**
     * Remove o marco e exclui os arquivos de foto associados.
     */
    public function destroy(Landmark $landmark)
    {
        // Exclui fisicamente as imagens armazenadas
        foreach ($landmark->photos as $photo) {
            if (Str::startsWith($photo->url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $photo->url));
            }
        }

        // Exclui o registro no banco
        $landmark->delete();

        return redirect()
            ->route('admin.landmarks.index')
            ->with('success', 'Marco histórico removido com sucesso!');
    }
}
