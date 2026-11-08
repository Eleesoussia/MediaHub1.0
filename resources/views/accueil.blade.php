@extends('layouts.app')

@section('titre', 'Accueil — MediaHub')

@section('contenu')
    <section class="hero">
        <h1>Bienvenue sur MediaHub</h1>
        <p>La plateforme de gestion et de diffusion de contenus multimédias.</p>
        <a href="{{ route('contenus.index') }}" class="btn">Découvrir les contenus</a>
    </section>
@endsection