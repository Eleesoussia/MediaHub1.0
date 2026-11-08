@extends('layouts.app')

@section('titre', 'Inscription — MediaHub')

@section('contenu')
    <div class="auth-form">
        <h1>Créer un compte</h1>

        @if ($errors->any())
            <div class="alerte alerte-erreur">
                <ul>
                    @foreach ($errors->all() as $erreur)
                        <li>{{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('inscription') }}" class="formulaire">
            @csrf

            <div class="form-groupe">
                <label for="name">Nom complet</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="form-groupe">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-groupe">
                <label for="password">Mot de passe (min 8 caractères)</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="form-groupe">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn">S'inscrire</button>

            <p style="margin-top:1rem; text-align:center;">
                Déjà un compte ? <a href="{{ route('connexion') }}">Se connecter</a>
            </p>
        </form>
    </div>
@endsection