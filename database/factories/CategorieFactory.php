<?php

namespace Database\Factories;

use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategorieFactory extends Factory
{
    protected $model = Categorie::class;

    public function definition(): array
    {
        $nom = $this->faker->unique()->randomElement([
            'Vidéo', 'Audio', 'Image', 'Documentaire', 'Podcast', 'Photographie',
        ]);

        return [
            'nom'  => $nom,
            'slug' => Str::slug($nom) . '-' . $this->faker->unique()->numberBetween(1, 999),
        ];
    }
}