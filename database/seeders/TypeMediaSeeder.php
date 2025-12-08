<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TypeMedia;

class TypeMediaSeeder extends Seeder
{
    public function run()
    {
        $types = [
            ['nom_media' => 'Image'],
            ['nom_media' => 'Audio'],
            ['nom_media' => 'Vidéo'],
            ['nom_media' => 'Document PDF'],
        ];

        foreach ($types as $type) {
            TypeMedia::create($type);
        }
    }
}