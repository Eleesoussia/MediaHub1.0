@extends('layouts.app')

@section('titre', 'Tableau de bord — Admin MediaHub')

@section('contenu')
    <h1>Tableau de bord administrateur</h1>

    <div class="stats-grille">
        <div class="stat-card">
            <div class="stat-nombre">{{ $stats['users'] }}</div>
            <div class="stat-label">Utilisateurs</div>
        </div>
        <div class="stat-card">
            <div class="stat-nombre">{{ $stats['categories'] }}</div>
            <div class="stat-label">Catégories</div>
        </div>
        <div class="stat-card">
            <div class="stat-nombre">{{ $stats['publications'] }}</div>
            <div class="stat-label">Publications</div>
        </div>
        <div class="stat-card">
            <div class="stat-nombre">{{ $stats['commentaires'] }}</div>
            <div class="stat-label">Commentaires</div>
        </div>
    </div>

    <h2 style="margin-top:2rem;">Dernières publications</h2>

    @if ($dernieresPublications->isEmpty())
        <p>Aucune publication.</p>
    @else
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dernieresPublications as $pub)
                    <tr>
                        <td>{{ $pub->id }}</td>
                        <td>
                            <a href="{{ route('contenus.show', $pub) }}">{{ $pub->titre }}</a>
                        </td>
                        <td>{{ $pub->auteur->name }}</td>
                        <td>{{ $pub->categorie->nom }}</td>
                        <td>{{ $pub->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection