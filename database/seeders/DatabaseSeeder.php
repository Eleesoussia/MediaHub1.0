<?php

namespace Database\Seeders;

use App\Models\Commentaire;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorieSeeder::class,
            AdminSeeder::class,
        ]);

        User::factory(3)->create(['role' => 'auteur']);
        Publication::factory(20)->create();

        // Ajoute 30 commentaires répartis sur les publications
        $users = User::all();
        $publications = Publication::all();

        foreach ($publications as $publication) {
            Commentaire::create([
                'contenu'        => 'Excellent contenu, très intéressant !',
                'publication_id' => $publication->id,
                'user_id'        => $users->random()->id,
            ]);
        }
    }
}