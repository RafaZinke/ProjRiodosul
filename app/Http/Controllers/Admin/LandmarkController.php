<?php
// File: app/Http/Controllers/Admin/LandmarkController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLandmarkRequest;
use App\Models\Landmark;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandmarkController extends Controller
{
    /**
     * Listagem paginada de marcos no admin.
     */
    public function index()
    {
        $landmarks = Landmark::withCount(['events', 'comments', 'evaluations'])
                             ->paginate(15);

        return view('admin.landmarks.index', compact('landmarks'));
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create()
    {
        return view('admin.landmarks.create');
    }

    /**
     * Armazena um novo marco, salvando apenas o caminho relativo
     * das fotos em “storage/...”.
     */
    public function store(StoreLandmarkRequest $request)
    {
        $data     = $request->validated();
        $landmark = Landmark::create($data);

        // Upload de arquivos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('images', 'public');      // ex: "images/abc.jpg"
                $url  = 'storage/' . $path;                    // ex: "storage/images/abc.jpg"

                $landmark->photos()->create([
                    'url'     => $url,
                    'caption' => null,
                ]);
            }
        }

        // URLs externas opcionais
        if ($request->filled('photo_urls')) {
            foreach ($request->input('photo_urls') as $url) {
                if (filter_var($url, FILTER_VALIDATE_URL) || Str::startsWith($url, 'storage/')) {
                    $landmark->photos()->create([
                        'url'     => $url,
                        'caption' => null,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.landmarks.index')
            ->with('success', 'Marco histórico criado com sucesso!');
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Landmark $landmark)
    {
        return view('admin.landmarks.edit', compact('landmark'));
    }

    /**
     * Atualiza um marco, adicionando novas fotos ou URLs.
     */
    public function update(StoreLandmarkRequest $request, Landmark $landmark)
    {
        $landmark->update($request->validated());

        // Upload de novos arquivos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('images', 'public');
                $url  = 'storage/' . $path;

                $landmark->photos()->create([
                    'url'     => $url,
                    'caption' => null,
                ]);
            }
        }

        // Novas URLs externas
        if ($request->filled('photo_urls')) {
            foreach ($request->input('photo_urls') as $url) {
                if (filter_var($url, FILTER_VALIDATE_URL) || Str::startsWith($url, 'storage/')) {
                    $landmark->photos()->create([
                        'url'     => $url,
                        'caption' => null,
                    ]);
                }
            }
        }

        return redirect()
            ->route('admin.landmarks.index')
            ->with('success', 'Marco histórico atualizado com sucesso!');
    }

    /**
     * Remove o marco e exclui fotos do disco.
     */
    public function destroy(Landmark $landmark)
    {
        // Apaga cada arquivo de foto do disco public
        foreach ($landmark->photos as $photo) {
            if (Str::startsWith($photo->url, 'storage/')) {
                $relative = Str::after($photo->url, 'storage/'); // ex: "images/abc.jpg"
                Storage::disk('public')->delete($relative);
            }
        }

        // Exclui registros de photos e o landmark
        $landmark->photos()->delete();
        $landmark->delete();

        return redirect()
            ->route('admin.landmarks.index')
            ->with('success', 'Marco histórico removido com sucesso!');
    }
}
