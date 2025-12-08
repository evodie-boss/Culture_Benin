<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Transaction; // AJOUT: Import du modèle Transaction

class ContenuController extends Controller
{
    public function index()
    {
        $contenus = Contenu::with(['region', 'langue'])
                           ->latest('date_creation')
                           ->paginate(12);

        return view('pages.contenus.index', compact('contenus'));
    }

    public function show(Contenu $contenu)
    {
        // On charge les relations nécessaires
        $contenu->load(['region', 'langue', 'medias', 'typeContenu', 'auteur']);
        
        // AJOUT: Charger les contenus similaires
        $similarContents = Contenu::where('id_contenu', '!=', $contenu->id_contenu)
            ->where(function($query) use ($contenu) {
                $query->where('id_region', $contenu->id_region)
                      ->orWhere('id_type_contenu', $contenu->id_type_contenu);
            })
            ->with(['region', 'typeContenu'])
            ->limit(6)
            ->get();

        return view('pages.contenus.show', compact('contenu', 'similarContents'));
    }

    /**
     * Afficher un contenu premium débloqué
     */
    public function premium(Contenu $contenu)
    {
        $user = auth()->user();
        
        // Vérifier l'accès
        if (!$contenu->utilisateurAAcces($user)) {
            return redirect()->route('contenus.show', $contenu)
                ->with('error', 'Vous n\'avez pas accès à ce contenu premium.');
        }
        
        // Récupérer la dernière transaction valide
        $transaction = Transaction::where('id_utilisateur', $user->id_utilisateur)
            ->where('id_contenu', $contenu->id_contenu)
            ->where('statut', 'payee')
            ->latest()
            ->first();
        
        $contenu->load(['region', 'langue', 'medias', 'auteur', 'typeContenu']);
        
        // AJOUT: Charger les contenus similaires
        $similarContents = Contenu::where('id_contenu', '!=', $contenu->id_contenu)
            ->where(function($query) use ($contenu) {
                $query->where('id_region', $contenu->id_region)
                      ->orWhere('id_type_contenu', $contenu->id_type_contenu);
            })
            ->with(['region', 'typeContenu'])
            ->limit(6)
            ->get();
        
        return view('pages.contenus.premium', compact('contenu', 'transaction', 'similarContents'));
    }
}