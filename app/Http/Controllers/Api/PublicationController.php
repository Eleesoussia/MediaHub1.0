<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePublicationRequest;
use App\Http\Requests\UpdatePublicationRequest;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PublicationController extends Controller
{
    /**
     * GET /api/publications (public)
     * Liste paginée avec filtres optionnels.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Publication::with(['categorie', 'auteur'])
            ->withCount('commentaires')
            ->latest();

        // Filtre par catégorie : ?categorie_id=2
        if ($request->has('categorie_id')) {
            $query->where('categorie_id', $request->categorie_id);
        }

        // Recherche : ?q=mot
        if ($request->has('q')) {
            $query->where('titre', 'like', '%' . $request->q . '%');
        }

        $publications = $query->paginate(10);

        return PublicationResource::collection($publications);
    }

    /**
     * GET /api/publications/{id} (public)
     */
    public function show(Publication $publication): PublicationResource
    {
        $publication->load(['categorie', 'auteur'])
            ->loadCount('commentaires');

        return new PublicationResource($publication);
    }

    /**
     * POST /api/publications (auth:sanctum)
     */
    public function store(StorePublicationRequest $request): JsonResponse
    {
        $this->authorize('create', Publication::class);

        $donnees = $request->validated();
        $donnees['user_id'] = $request->user()->id;

        // Upload image (optionnel)
        if ($request->hasFile('image')) {
            $donnees['image'] = $request->file('image')->store('publications', 'public');
        }

        // Upload média (optionnel)
        if ($request->hasFile('fichier_media')) {
            $fichier = $request->file('fichier_media');
            $donnees['fichier_media'] = $fichier->store('medias', 'public');
            $donnees['type_media'] = str_starts_with($fichier->getMimeType(), 'audio') ? 'audio' : 'video';
        }

        $publication = Publication::create($donnees);
        $publication->load(['categorie', 'auteur']);

        return (new PublicationResource($publication))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * PUT/PATCH /api/publications/{id} (auth:sanctum + policy)
     */
    public function update(UpdatePublicationRequest $request, Publication $publication): PublicationResource
    {
        $this->authorize('update', $publication);

        $donnees = $request->validated();

        if ($request->hasFile('image')) {
            if ($publication->image) {
                \Storage::disk('public')->delete($publication->image);
            }
            $donnees['image'] = $request->file('image')->store('publications', 'public');
        }

        if ($request->hasFile('fichier_media')) {
            if ($publication->fichier_media) {
                \Storage::disk('public')->delete($publication->fichier_media);
            }
            $fichier = $request->file('fichier_media');
            $donnees['fichier_media'] = $fichier->store('medias', 'public');
            $donnees['type_media'] = str_starts_with($fichier->getMimeType(), 'audio') ? 'audio' : 'video';
        }

        $publication->update($donnees);
        $publication->load(['categorie', 'auteur']);

        return new PublicationResource($publication);
    }

    /**
     * DELETE /api/publications/{id} (auth:sanctum + policy)
     */
    public function destroy(Publication $publication): JsonResponse
    {
        $this->authorize('delete', $publication);

        if ($publication->image) {
            \Storage::disk('public')->delete($publication->image);
        }
        if ($publication->fichier_media) {
            \Storage::disk('public')->delete($publication->fichier_media);
        }

        $publication->delete();

        return response()->json(null, 204);
    }
}