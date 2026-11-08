<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::withCount('publications')->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategorieRequest $request)
    {
        Categorie::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie créée avec succès.');
    }

    public function show(Categorie $categorie)
    {
        $publications = $categorie->publications()
            ->with('auteur')
            ->latest()
            ->paginate(9);

        return view('contenus.index', [
            'publications' => $publications,
            'categories'   => Categorie::withCount('publications')->get(),
            'titrePage'    => 'Catégorie : ' . $categorie->nom,
        ]);
    }

    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('succes', 'Catégorie modifiée avec succès.');
    }

    public function destroy(Categorie $categorie)
    {
        try {
            $categorie->delete();
            return redirect()
                ->route('categories.index')
                ->with('succes', 'Catégorie supprimée.');
        } catch (\Exception $e) {
            return redirect()
                ->route('categories.index')
                ->with('erreur', 'Impossible de supprimer : des publications sont liées.');
        }
    }
}