<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nom' => 'Admin',
                'prenom' => 'System',
                'email' => 'admin@culturebenin.bj',
                'mot_de_passe' => Hash::make('password'),
                'sexe' => 'M',
                'date_naissance' => '1980-01-01',
                'date_inscription' => now(),
                'statut' => 'actif',
                'id_role' => 1,
                'id_langue' => 1,
            ],
            [
                'nom' => 'Modo',
                'prenom' => 'Culture',
                'email' => 'modo@culturebenin.bj',
                'mot_de_passe' => Hash::make('password'),
                'sexe' => 'F',
                'date_naissance' => '1985-05-15',
                'date_inscription' => now(),
                'statut' => 'actif',
                'id_role' => 2,
                'id_langue' => 1,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}