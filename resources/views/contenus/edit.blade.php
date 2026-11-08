@extends('layouts.app')

@section('titre', 'Modifier publication — MediaHub')

@section('contenu')
    <h1>Modifier : {{ $publication->titre }}</h1>

    @if ($errors->any())
        <div class="alerte alerte-erreur">
            <ul>
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('contenus.update', $publication) }}"
          enctype="multipart/form-data" class="formulaire">
        @csrf
        @method('PUT')

        <div class="form-groupe">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" value="{{ old('titre', $publication->titre) }}" required>
            @error('titre') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        <div class="form-groupe">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" rows="8" required>{{ old('contenu', $publication->contenu) }}</textarea>
            @error('contenu') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        <div class="form-groupe">
            <label for="categorie_id">Catégorie</label>
            <select name="categorie_id" id="categorie_id" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}"
                        @selected(old('categorie_id', $publication->categorie_id) == $categorie->id)>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        @if ($publication->image)
            <p>Image actuelle : <img src="{{ Storage::url($publication->image) }}" alt="" style="max-height:80px;"></p>
        @endif
        <div class="form-groupe">
            <label for="image">Nouvelle image (optionnelle)</label>
            <input type="file" name="image" id="image" accept="image/*">
            @error('image') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        @if ($publication->fichier_media)
            <p>Média actuel : {{ $publication->type_media }} ({{ $publication->fichier_media }})</p>
        @endif
        <div class="form-groupe">
            <label for="fichier_media">Nouveau média (optionnel)</label>
            <input type="file" name="fichier_media" id="fichier_media" accept="audio/*,video/*">
            @error('fichier_media') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Enregistrer</button>
        <a href="{{ route('contenus.show', $publication) }}" class="btn btn-secondaire">Annuler</a>
    </form>
@endsection