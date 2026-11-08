@extends('layouts.app')

@section('titre', 'Connexion — MediaHub')

@section('contenu')
    <div class="auth-form">
        <h1>Connexion</h1>

        @if ($errors->any())
            <div class="alerte alerte-erreur">
                <ul>
                    @foreach ($errors->all() as $erreur)
                        <li>{{ $erreur }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('connexion') }}" class="formulaire">
            @csrf

            <div class="form-groupe">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-groupe">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn">Se connecter</button>

            <p style="margin-top:1rem; text-align:center;">
                Pas encore de compte ? <a href="{{ route('inscription') }}">S'inscrire</a>
            </p>
        </form>

        <div class="alerte" style="background:#fef3c7;color:#92400e;margin-top:1rem;">
            <strong>Comptes de démo :</strong><br>
            Admin : <code>admin@mediahub.tn</code> / <code>password</code><br>
            Auteur : <code>auteur@mediahub.tn</code> / <code>password</code>
        </div>
    </div>
@endsection