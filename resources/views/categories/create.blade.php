@extends('layouts.app')

@section('titre', 'Nouvelle catégorie — MediaHub')

@section('contenu')
    <h1>Nouvelle catégorie</h1>

    @if ($errors->any())
        <div class="alerte alerte-erreur">
            <ul>
                @foreach ($errors->all() as $erreur)
                    <li>{{ $erreur }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('categories.store') }}" class="formulaire">
        @csrf

        <div class="form-groupe">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required>
            @error('nom') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        <div class="form-groupe">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required>
            @error('slug') <span class="erreur-champ">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Créer</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondaire">Annuler</a>
    </form>
@endsection