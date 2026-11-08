<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategorieResource;
use App\Models\Categorie;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategorieController extends Controller
{
    /**
     * GET /api/categories (public)
     * Liste avec count des publications.
     */
    public function index(): AnonymousResourceCollection
    {
        $categories = Categorie::withCount('publications')->get();

        return CategorieResource::collection($categories);
    }
}