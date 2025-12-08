<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DemandeContributeur;
use App\Models\Role;

class ContributorRequestController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        if ($user->estContributeur() || $user->estAdmin()) {
            return redirect('/')->with('info', 'Vous avez déjà les droits de contributeur');
        }

        // Si déjà une demande en attente
        if (DemandeContributeur::where('id_utilisateur', $user->id_utilisateur)->where('statut', 'en_attente')->exists()) {
            return redirect('/')->with('info', 'Votre demande est déjà en cours de traitement');
        }

        return view('contributor.request');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->estContributeur() || $user->estAdmin()) {
            return redirect('/')->with('info', 'Vous êtes déjà contributeur');
        }

        DemandeContributeur::create([
            'id_utilisateur' => $user->id_utilisateur,
            'message' => $request->message,
            'statut' => 'en_attente',
        ]);

        return redirect('/')->with('success', 'Votre demande a été envoyée ! L’administrateur va l’examiner.');
    }
}