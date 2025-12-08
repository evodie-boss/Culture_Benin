<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        $regions = [
            [
                'nom_region' => 'Atlantique', 
                'description' => 'Département côtier avec riche patrimoine culturel',
                'population' => 1400000,
                'superficie' => 3233,
                'localisation' => 'Sud du Bénin'
            ],
            [
                'nom_region' => 'Zou', 
                'description' => 'Région historique avec le royaume de Danxomè',
                'population' => 850000,
                'superficie' => 5243,
                'localisation' => 'Centre du Bénin'
            ],
            [
                'nom_region' => 'Mono', 
                'description' => 'Région lacustre et traditions vivantes',
                'population' => 500000,
                'superficie' => 1605,
                'localisation' => 'Sud-Ouest'
            ],
            [
                'nom_region' => 'Atacora', 
                'description' => 'Région montagneuse avec diversité ethnique',
                'population' => 770000,
                'superficie' => 20499,
                'localisation' => 'Nord-Ouest'
            ],
        ];

        foreach ($regions as $regionData) {
            Region::create($regionData);
        }
        
        // On ajoutera les relations langues plus tard via un autre seeder
    }
}