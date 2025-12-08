<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Models\Media;
use App\Models\Transaction; // AJOUT: Import du modèle Transaction
use App\Models\Role; // AJOUT: Pour les rôles

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistiques principales
        $stats = [
            'total_users' => User::count(),
            'total_contents' => Contenu::count(),
            'total_comments' => Commentaire::count(),
            'total_medias' => Media::count(),
        ];
        
        // AJOUT: Récupération des rôles avec relations
        $adminRole = Role::where('nom_role', 'Administrateur')->first();
        $moderatorRole = Role::where('nom_role', 'Modérateur')->first();
        $lecteurRole = Role::where('nom_role', 'Lecteur')->first();
        $contributeurRole = Role::where('nom_role', 'Contributeur')->first();
        
        // AJOUT: Comptage des utilisateurs par rôle avec vérification
        $stats['admin_users'] = $adminRole ? User::where('id_role', $adminRole->id_role)->count() : 0;
        $stats['moderator_users'] = $moderatorRole ? User::where('id_role', $moderatorRole->id_role)->count() : 0;
        $stats['standard_users'] = $lecteurRole ? User::where('id_role', $lecteurRole->id_role)->count() : 0;
        $stats['contributeur_users'] = $contributeurRole ? User::where('id_role', $contributeurRole->id_role)->count() : 0;

        // AJOUT: Statistiques premium
        $stats['premium_contents'] = Contenu::where('est_premium', true)->count();
        $stats['free_contents'] = Contenu::where('type_acces', 'gratuit')->count();
        $stats['premium_percentage'] = $stats['total_contents'] > 0 ? 
            round(($stats['premium_contents'] / $stats['total_contents']) * 100, 1) : 0;
        
        // AJOUT: Statistiques transactions
        $stats['total_transactions'] = Transaction::count();
        $stats['transactions_payees'] = Transaction::where('statut', 'payee')->count();
        $stats['transactions_payees_percentage'] = $stats['total_transactions'] > 0 ? 
            round(($stats['transactions_payees'] / $stats['total_transactions']) * 100, 1) : 0;
        
        // AJOUT: Revenu total
        $stats['total_revenue'] = Transaction::where('statut', 'payee')->sum('montant');
        
        // AJOUT: Autres statistiques contenus
        $stats['pending_contents'] = Contenu::where('statut', 'en_attente')->count();
        $stats['validated_contents'] = Contenu::where('statut', 'validé')->count();
        $stats['draft_contents'] = Contenu::where('statut', 'brouillon')->count();

        // Calcul des pourcentages utilisateurs
        $totalUsers = $stats['total_users'] ?: 1;
        $stats['admin_percentage'] = round(($stats['admin_users'] / $totalUsers) * 100);
        $stats['moderator_percentage'] = round(($stats['moderator_users'] / $totalUsers) * 100);
        $stats['standard_percentage'] = round(($stats['standard_users'] / $totalUsers) * 100);
        $stats['contributeur_percentage'] = round(($stats['contributeur_users'] / $totalUsers) * 100);

        // Activité récente - AJOUT: Activités premium
        $recentActivities = [
            [
                'icon' => 'user-plus',
                'color' => 'green',
                'title' => 'Nouvel utilisateur inscrit',
                'description' => 'Un nouvel utilisateur s\'est inscrit sur la plateforme',
                'time' => '2 min'
            ],
            [
                'icon' => 'comment',
                'color' => 'blue',
                'title' => 'Nouveau commentaire',
                'description' => 'Un utilisateur a commenté un contenu culturel',
                'time' => '15 min'
            ],
            [
                'icon' => 'file-alt',
                'color' => 'purple',
                'title' => 'Contenu publié',
                'description' => 'Nouvel article culturel publié',
                'time' => '1 h'
            ],
        ];

        // AJOUT: Ajouter des activités récentes de transactions si elles existent
        $recentTransactions = Transaction::with(['utilisateur', 'contenu'])
            ->latest()
            ->take(3)
            ->get();
            
        foreach ($recentTransactions as $transaction) {
            $recentActivities[] = [
                'icon' => 'credit-card',
                'color' => $transaction->statut === 'payee' ? 'green' : 'orange',
                'title' => $transaction->statut === 'payee' ? 'Transaction payée' : 'Transaction en attente',
                'description' => $transaction->utilisateur->prenom . ' - ' . number_format($transaction->montant, 0, ',', ' ') . ' XOF',
                'time' => $transaction->created_at->diffForHumans()
            ];
        }

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }

    // Vos autres méthodes admin...
}