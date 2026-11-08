<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition(): array
    {
        return [
            'titre'        => $this->faker->sentence(6),
            'contenu'      => $this->faker->paragraphs(3, true),
            'categorie_id' => Categorie::inRandomOrder()->first()?->id ?? Categorie::factory(),
            'user_id'      => User::inRandomOrder()->first()?->id ?? User::factory(),
            'image'        => null,
            'fichier_media'=> null,
            'type_media'   => $this->faker->randomElement([null, 'audio', 'video']),
        ];
    }
}