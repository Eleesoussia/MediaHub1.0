<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nom' => 'Vidéo',   'slug' => 'video'],
            ['nom' => 'Audio',   'slug' => 'audio'],
            ['nom' => 'Image',   'slug' => 'image'],
            ['nom' => 'Podcast', 'slug' => 'podcast'],
        ];

        foreach ($categories as $cat) {
            Categorie::firstOrCreate(['slug' => $cat['slug']], $cat);
        }
    }
}