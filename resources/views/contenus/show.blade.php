@extends('layouts.app')

@section('titre', $publication->titre . ' — MediaHub')

@section('contenu')
    <article class="publication-detail">
        <div class="entete-page">
            <h1>{{ $publication->titre }}</h1>
            <div class="actions">
                @can('update', $publication)
                    <a href="{{ route('contenus.edit', $publication) }}" class="btn btn-petit btn-secondaire">Modifier</a>
                @endcan

                @can('delete', $publication)
                    <form method="POST" action="{{ route('contenus.destroy', $publication) }}"
                          onsubmit="return confirm('Supprimer cette publication ?');"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-petit btn-danger">Supprimer</button>
                    </form>
                @endcan
            </div>
        </div>

        <p class="meta">
            Par <strong>{{ $publication->auteur->name }}</strong>
            · Catégorie : <a href="{{ route('categories.show', $publication->categorie) }}">
                {{ $publication->categorie->nom }}
            </a>
            · {{ $publication->created_at->format('d/m/Y') }}
        </p>

        @if ($publication->image)
            <img src="{{ Storage::url($publication->image) }}"
                 alt="{{ $publication->titre }}"
                 class="publication-image">
        @endif

        @if ($publication->fichier_media && $publication->type_media === 'audio')
            <audio controls src="{{ Storage::url($publication->fichier_media) }}" style="width:100%;margin:1rem 0;"></audio>
        @elseif ($publication->fichier_media && $publication->type_media === 'video')
            <video controls src="{{ Storage::url($publication->fichier_media) }}" style="width:100%;margin:1rem 0;"></video>
        @endif

        <div class="contenu-texte">
            {!! nl2br(e($publication->contenu)) !!}
        </div>

        <hr>

        <h2>Commentaires ({{ $publication->commentaires->count() }})</h2>

        @forelse ($publication->commentaires as $commentaire)
            <div class="commentaire">
                <strong>{{ $commentaire->auteur->name }}</strong>
                <small>{{ $commentaire->created_at->format('d/m/Y H:i') }}</small>
                <p>{{ $commentaire->contenu }}</p>
            </div>
        @empty
            <p>Aucun commentaire pour le moment.</p>
        @endforelse

        <a href="{{ route('contenus.index') }}" class="btn btn-petit">← Retour aux contenus</a>
    </article>
@endsection