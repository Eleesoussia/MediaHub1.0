<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@mediahub.tn'],
            [
                'name'     => 'Admin MediaHub',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'auteur@mediahub.tn'],
            [
                'name'     => 'Auteur Demo',
                'password' => Hash::make('password'),
                'role'     => 'auteur',
            ]
        );
    }
}