<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\Publication;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users'         => User::count(),
            'categories'    => Categorie::count(),
            'publications'  => Publication::count(),
            'commentaires'  => Commentaire::count(),
        ];

        $dernieresPublications = Publication::with(['auteur', 'categorie'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'dernieresPublications'));
    }
}