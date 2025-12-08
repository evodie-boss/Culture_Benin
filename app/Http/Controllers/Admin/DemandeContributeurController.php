<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeContributeur;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeContributeurController extends Controller
{
    // Supprimez complètement le constructeur pour l'instant
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:Administrateur']);
    // }

    // Liste des demandes en attente
    public function index()
    {
        // Vérification manuelle en attendant
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        if (!$user->estAdmin()) {
            return redirect('/')->with('error', 'Accès réservé aux administrateurs.');
        }

        $demandes = DemandeContributeur::with('utilisateur')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'en_attente' => DemandeContributeur::where('statut', 'en_attente')->count(),
            'validees' => DemandeContributeur::where('statut', 'validée')->count(),
            'refusees' => DemandeContributeur::where('statut', 'refusée')->count(),
        ];

        return view('admin.demandes.index', compact('demandes', 'stats'));
    }

    // Voir le détail d'une demande
    public function show($id)
    {
        if (!Auth::check() || !Auth::user()->estAdmin()) {
            return redirect('/')->with('error', 'Accès réservé aux administrateurs.');
        }

        $demande = DemandeContributeur::with(['utilisateur'])
            ->findOrFail($id);

        return view('admin.demandes.show', compact('demande'));
    }

    // Valider une demande
    public function valider(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->estAdmin()) {
            return redirect('/')->with('error', 'Accès réservé aux administrateurs.');
        }

        $request->validate([
            'commentaire' => 'nullable|string|max:500',
        ]);

        $demande = DemandeContributeur::findOrFail($id);
        $user = $demande->utilisateur;

        // Trouver le rôle Contributeur
        $roleContributeur = Role::where('nom_role', 'Contributeur')->firstOrFail();

        // Mettre à jour l'utilisateur
        $user->update([
            'id_role' => $roleContributeur->id_role,
        ]);

        // Mettre à jour la demande
        $demande->update([
            'statut' => 'validée',
            'commentaire_admin' => $request->commentaire,
            'traitee_le' => now(),
            'traitee_par' => Auth::id(),
        ]);

        return redirect()->route('admin.demandes.index')
            ->with('success', 'Demande validée. L\'utilisateur est maintenant contributeur.');
    }

    // Refuser une demande
    public function refuser(Request $request, $id)
    {
        if (!Auth::check() || !Auth::user()->estAdmin()) {
            return redirect('/')->with('error', 'Accès réservé aux administrateurs.');
        }

        $request->validate([
            'commentaire' => 'required|string|max:500',
        ]);

        $demande = DemandeContributeur::findOrFail($id);

        $demande->update([
            'statut' => 'refusée',
            'commentaire_admin' => $request->commentaire,
            'traitee_le' => now(),
            'traitee_par' => Auth::id(),
        ]);

        return redirect()->route('admin.demandes.index')
            ->with('success', 'Demande refusée.');
    }

    // Historique des demandes traitées
    public function historique()
    {
        if (!Auth::check() || !Auth::user()->estAdmin()) {
            return redirect('/')->with('error', 'Accès réservé aux administrateurs.');
        }

        $demandes = DemandeContributeur::with(['utilisateur'])
            ->whereIn('statut', ['validée', 'refusée'])
            ->orderBy('traitee_le', 'desc')
            ->paginate(15);

        return view('admin.demandes.historique', compact('demandes'));
    }
}