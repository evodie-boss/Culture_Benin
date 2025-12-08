<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeContenu;

class TypeContenuSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['nom_contenu' => 'Histoire et conte traditionnel'],
            ['nom_contenu' => 'Recette culinaire'],
            ['nom_contenu' => 'Article culturel'],
            ['nom_contenu' => 'Chanson traditionnelle'],
            ['nom_contenu' => 'Danse et pratique rituelle'],
        ];

        foreach ($types as $type) {
            TypeContenu::create($type);
        }
    }
}