@extends('layouts.app')

@section('titre', 'À propos — MediaHub')

@section('contenu')
    <h1>À propos de MediaHub</h1>
    <p>
        MediaHub est une plateforme de gestion et de diffusion de contenus multimédias
        développée dans le cadre du module <strong>Atelier Framework côté serveur — Laravel</strong>,
        en 3ᵉ année Licence Technologies de l'Information.
    </p>

    <h2>Fonctionnalités</h2>
    <ul>
        <li>Publication de contenus multimédias (images, audio, vidéo)</li>
        <li>Catégorisation et tags</li>
        <li>Commentaires</li>
        <li>Authentification et rôles (auteur / administrateur)</li>
        <li>API REST</li>
    </ul>
@endsection