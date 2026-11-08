<?php

namespace App\Providers;

use App\Models\Publication;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gate : seul un admin peut gérer les catégories
        Gate::define('gerer-categories', function (User $user) {
            return $user->role === 'admin';
        });

        // Policy : PublicationPolicy pour le modèle Publication
        Gate::policy(Publication::class, \App\Policies\PublicationPolicy::class);
    }
}