<?php
// database/seeders/PremiumContentSeeder.php

namespace Database\Seeders;

use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Database\Seeder;

class PremiumContentSeeder extends Seeder
{
    public function run(): void
    {
        // Vérifier que nous avons des données de base
        $user = User::first();
        $region = Region::first();
        $langue = Langue::first();
        $typeContenu = TypeContenu::first();

        if (!$user || !$region || !$langue || !$typeContenu) {
            $this->command->error('Veuillez d\'abord exécuter les seeders de base.');
            return;
        }

        // Contenu premium payant
        Contenu::create([
            'titre' => 'L\'Histoire Secrète du Roi Béhanzin',
            'texte' => '<h2>Introduction</h2><p>Ce contenu exclusif révèle des aspects méconnus de la vie du Roi Béhanzin, dernier roi du Dahomey...</p><h2>Les Stratégies Militaires</h2><p>Le roi Béhanzin était un stratège militaire hors pair...</p><h2>L\'Héritage Culturel</h2><p>Son influence sur la culture béninoise moderne est considérable...</p>',
            'date_creation' => now(),
            'statut' => 'validé',
            'id_region' => $region->id_region,
            'id_langue' => $langue->id_langue,
            'id_type_contenu' => $typeContenu->id_type_contenu,
            'id_auteur' => $user->id_utilisateur,
            'type_acces' => 'payant',
            'prix' => 5000,
            'devise' => 'XOF',
            'est_premium' => true,
            'duree_acces' => '30j',
            'apercu' => 'Découvrez les secrets bien gardés du dernier roi du Dahomey. Cette histoire exclusive vous révèlera des aspects méconnus de sa vie, ses stratégies militaires et son héritage culturel qui continue d\'influencer le Bénin moderne.'
        ]);

        // Contenu premium gratuit
        Contenu::create([
            'titre' => 'Les Danses Traditionnelles de l\'Atacora',
            'texte' => '<h2>Introduction aux Danses</h2><p>Les danses traditionnelles de la région de l\'Atacora sont parmi les plus riches et diversifiées du Bénin...</p><h2>Significations Culturelles</h2><p>Chaque mouvement, chaque rythme a une signification particulière...</p>',
            'date_creation' => now(),
            'statut' => 'validé',
            'id_region' => $region->id_region,
            'id_langue' => $langue->id_langue,
            'id_type_contenu' => $typeContenu->id_type_contenu,
            'id_auteur' => $user->id_utilisateur,
            'type_acces' => 'gratuit',
            'prix' => 0,
            'devise' => 'XOF',
            'est_premium' => false,
            'apercu' => null
        ]);

        // Autre contenu payant
        Contenu::create([
            'titre' => 'Recettes Secrètes de la Cuisine Goun',
            'texte' => '<h2>Introduction à la Cuisine Goun</h2><p>La cuisine goun est réputée pour ses saveurs uniques et ses techniques de préparation traditionnelles...</p><h2>Recette Exclusives</h2><p>Découvrez des recettes transmises de génération en génération...</p>',
            'date_creation' => now(),
            'statut' => 'validé',
            'id_region' => $region->id_region,
            'id_langue' => $langue->id_langue,
            'id_type_contenu' => $typeContenu->id_type_contenu,
            'id_auteur' => $user->id_utilisateur,
            'type_acces' => 'payant',
            'prix' => 3000,
            'devise' => 'XOF',
            'est_premium' => true,
            'duree_acces' => '7j',
            'apercu' => 'Accédez à des recettes traditionnelles goun gardées secrètes depuis des générations. Apprenez les techniques de préparation authentiques et les combinaisons d\'épices uniques qui font la renommée de cette cuisine.'
        ]);

        $this->command->info('3 contenus de test créés (2 premium, 1 gratuit)');
    }
}