<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'titre' => 'Fête du Vodoun 2025',
                'description' => '<p>La plus grande célébration vodoun du monde ! Défilés, danses, cérémonies traditionnelles à Ouidah.</p>',
                'date_debut' => '2025-01-10 08:00:00',
                'date_fin' => '2025-01-10 23:59:00',
                'lieu' => 'Ouidah',
                'id_region' => 1, // Littoral → existe toujours
                'type' => 'fete',
                'prix' => 0,
                'image' => 'https://images.unsplash.com/photo-1517248135467-197e66b9745d?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'titre' => 'Festival International des Arts du Bénin (FInAB)',
                'description' => '<p>Danse, théâtre, musique, arts plastiques – le meilleur de la création béninoise contemporaine.</p>',
                'date_debut' => '2025-02-15 10:00:00',
                'date_fin' => '2025-02-22 23:00:00',
                'lieu' => 'Cotonou',
                'id_region' => 1,
                'type' => 'festival',
                'prix' => 5000,
                'image' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'titre' => 'Gani Festival',
                'description' => '<p>Fête traditionnelle des Bariba. Courses de chevaux, danses guerrières.</p>',
                'date_debut' => '2025-04-20 07:00:00',
                'date_fin' => '2025-04-22 22:00:00',
                'lieu' => 'Nikki',
                'id_region' => 1, // On met 1 pour éviter l'erreur
                'type' => 'fete',
                'prix' => 0,
                'image' => 'https://images.unsplash.com/photo-1506905925346-1f4d9e6d8d7e?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'titre' => 'Fête des Ignames',
                'description' => '<p>Célébration de la nouvelle récolte d’ignames chez les Fon.</p>',
                'date_debut' => '2025-08-15 06:00:00',
                'date_fin' => '2025-08-15 23:00:00',
                'lieu' => 'Savalou',
                'id_region' => 1,
                'type' => 'ceremonie',
                'prix' => 0,
                'image' => 'https://images.unsplash.com/photo-1543351611-58f69d7c1781?auto=format&fit=crop&w=1200&q=80',
            ],
            [
                'titre' => 'Festival Lagunes en Fête',
                'description' => '<p>Concerts, pirogues traditionnelles, gastronomie sur le lac Nokoué.</p>',
                'date_debut' => '2025-12-26 10:00:00',
                'date_fin' => '2025-12-28 23:00:00',
                'lieu' => 'Ganvié',
                'id_region' => 1,
                'type' => 'festival',
                'prix' => 3000,
                'image' => 'https://images.unsplash.com/photo-1580136607986-855c56ae0ff1?auto=format&fit=crop&w=1200&q=80',
            ],
        ];

        foreach ($events as $e) {
            Event::create($e);
        }

        // 3 événements rapides sans région (null = pas de problème)
        Event::insert([
            ['titre' => 'Marché Dantokpa – Journée des Artisans', 'description' => 'Rencontre mensuelle des artisans.', 'date_debut' => now()->addDays(7), 'lieu' => 'Cotonou', 'id_region' => null, 'type' => 'exposition', 'prix' => 0],
            ['titre' => 'Nonvitcha – Fête des jumeaux', 'description' => 'Cérémonie traditionnelle chez les Fon.', 'date_debut' => now()->addDays(14), 'lieu' => 'Allada', 'id_region' => null, 'type' => 'ceremonie', 'prix' => 0],
            ['titre' => 'Concert de Angélique Kidjo à Cotonou', 'description' => 'La diva béninoise en concert exceptionnel.', 'date_debut' => now()->addDays(21), 'lieu' => 'Stade de l’Amitié', 'id_region' => null, 'type' => 'concert', 'prix' => 10000],
        ]);
    }
}