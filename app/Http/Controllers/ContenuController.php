<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Models\Categorie;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ContenuController extends Controller
{
    public function index()
    {
        $publications = Publication::with(['categorie', 'auteur'])
            ->withCount('commentaires')
            ->latest()
            ->paginate(9);

        $categories = Categorie::withCount('publications')->get();

        return view('contenus.index', compact('publications', 'categories'));
    }

    public function create()
    {
        Gate::authorize('create', Publication::class);

        $categories = Categorie::orderBy('nom')->get();

        return view('contenus.create', compact('categories'));
    }

    public function store(StorePublicationRequest $request)
    {
        Gate::authorize('create', Publication::class);

        $donnees = $request->validated();

        if ($request->hasFile('image')) {
            $donnees['image'] = $request->file('image')->store('publications', 'public');
        }

        if ($request->hasFile('fichier_media')) {
            $fichier = $request->file('fichier_media');
            $donnees['fichier_media'] = $fichier->store('medias', 'public');
            $donnees['type_media'] = str_starts_with($fichier->getMimeType(), 'audio') ? 'audio' : 'video';
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $donnees['user_id'] = $user->id;

        $publication = Publication::create($donnees);

        return redirect()
            ->route('contenus.show', $publication)
            ->with('succes', 'Publication créée avec succès.');
    }

    public function show(Publication $publication)
    {
        $publication->load(['categorie', 'auteur', 'commentaires.auteur']);

        return view('contenus.show', compact('publication'));
    }

    public function edit(Publication $publication)
    {
        Gate::authorize('update', $publication);

        $categories = Categorie::orderBy('nom')->get();

        return view('contenus.edit', compact('publication', 'categories'));
    }

    public function update(UpdatePublicationRequest $request, Publication $publication)
    {
        Gate::authorize('update', $publication);

        $donnees = $request->validated();

        if ($request->hasFile('image')) {
            if ($publication->image) {
                Storage::disk('public')->delete($publication->image);
            }
            $donnees['image'] = $request->file('image')->store('publications', 'public');
        }

        if ($request->hasFile('fichier_media')) {
            if ($publication->fichier_media) {
                Storage::disk('public')->delete($publication->fichier_media);
            }
            $fichier = $request->file('fichier_media');
            $donnees['fichier_media'] = $fichier->store('medias', 'public');
            $donnees['type_media'] = str_starts_with($fichier->getMimeType(), 'audio') ? 'audio' : 'video';
        }

        $publication->update($donnees);

        return redirect()
            ->route('contenus.show', $publication)
            ->with('succes', 'Publication modifiée avec succès.');
    }

    public function destroy(Publication $publication)
    {
        Gate::authorize('delete', $publication);

        if ($publication->image) {
            Storage::disk('public')->delete($publication->image);
        }
        if ($publication->fichier_media) {
            Storage::disk('public')->delete($publication->fichier_media);
        }

        $publication->delete();

        return redirect()
            ->route('contenus.index')
            ->with('succes', 'Publication supprimée.');
    }
}