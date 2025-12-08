<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Langue;

class LangueSeeder extends Seeder
{
    public function run()
    {
        $langues = [
            ['nom_langue' => 'Fon', 'code_langue' => 'fon', 'description' => 'Langue majoritaire du Sud-Bénin'],
            ['nom_langue' => 'Yoruba', 'code_langue' => 'yor', 'description' => 'Langue parlée dans le Sud-Est'],
            ['nom_langue' => 'Dendi', 'code_langue' => 'den', 'description' => 'Langue du Nord-Bénin'],
            ['nom_langue' => 'Goun', 'code_langue' => 'gun', 'description' => 'Langue du département de l\'Atlantique'],
            ['nom_langue' => 'Bariba', 'code_langue' => 'bba', 'description' => 'Langue du Nord-Est'],
            ['nom_langue' => 'Français', 'code_langue' => 'fr', 'description' => 'Langue officielle'],
        ];

        foreach ($langues as $langue) {
            Langue::create($langue);
        }
    }
}