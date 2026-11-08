@extends('layouts.app')

@section('titre', 'Catégories — MediaHub')

@section('contenu')
    <div class="entete-page">
        <h1>Catégories</h1>

        @can('gerer-categories')
            <a href="{{ route('categories.create') }}" class="btn">+ Nouvelle catégorie</a>
        @endcan
    </div>

    @if ($categories->isEmpty())
        <p>Aucune catégorie disponible.</p>
    @else
        <div class="grille">
            @foreach ($categories as $categorie)
                <x-carte
                    :titre="$categorie->nom"
                    :meta="$categorie->publications_count . ' publication(s)'"
                >
                    <div class="actions">
                        <a href="{{ route('categories.show', $categorie) }}" class="btn btn-petit">Voir</a>

                        @can('gerer-categories')
                            <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-petit btn-secondaire">Modifier</a>

                            <form method="POST" action="{{ route('categories.destroy', $categorie) }}"
                                  onsubmit="return confirm('Supprimer cette catégorie ?');"
                                  style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-petit btn-danger">Supprimer</button>
                            </form>
                        @endcan
                    </div>
                </x-carte>
            @endforeach
        </div>
    @endif
@endsection