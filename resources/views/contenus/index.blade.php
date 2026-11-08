@extends('layouts.app')

@section('titre', $titrePage ?? 'Contenus — MediaHub')

@section('contenu')
    <div class="entete-page">
        <h1>{{ $titrePage ?? 'Contenus multimédias' }}</h1>
        <a href="{{ route('contenus.create') }}" class="btn">+ Nouvelle publication</a>
    </div>

    @if ($categories->isNotEmpty())
        <div class="filtres">
            @foreach ($categories as $cat)
                <a href="{{ route('categories.show', $cat) }}" class="badge">
                    {{ $cat->nom }} ({{ $cat->publications_count }})
                </a>
            @endforeach
        </div>
    @endif

    @if ($publications->isEmpty())
        <p>Aucun contenu disponible pour le moment.</p>
    @else
        <div class="grille">
            @foreach ($publications as $publication)
                <x-carte
                    :titre="$publication->titre"
                    :meta="$publication->categorie->nom . ' · ' . $publication->auteur->name . ' · ' . $publication->commentaires_count . ' commentaire(s)'"
                >
                    <p>{{ \Illuminate\Support\Str::limit($publication->contenu, 120) }}</p>

                    @if ($publication->image)
                        <img src="{{ Storage::url($publication->image) }}"
                             alt="{{ $publication->titre }}"
                             class="carte-image">
                    @endif

                    <div class="actions">
                        <a href="{{ route('contenus.show', $publication) }}" class="btn btn-petit">Lire</a>
                        <a href="{{ route('contenus.edit', $publication) }}" class="btn btn-petit btn-secondaire">Modifier</a>

                        <form method="POST" action="{{ route('contenus.destroy', $publication) }}"
                              onsubmit="return confirm('Supprimer cette publication ?');"
                              style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-petit btn-danger">Suppr.</button>
                        </form>
                    </div>
                </x-carte>
            @endforeach
        </div>

        <div class="pagination">
            {{ $publications->links() }}
        </div>
    @endif
@endsection