<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use App\Models\User;
use Illuminate\Http\Request;

class ContenusController extends Controller
{
    public function index()
    {
        $contenus = Contenu::with(['region', 'langue', 'typeContenu', 'auteur'])->get();
        return view('contenus.index', compact('contenus'));
    }

    public function create()
    {
        $regions = Region::all();
        $langues = Langue::all();
        $typeContenus = TypeContenu::all();
        $auteurs = User::all();
        
        // AJOUT: Options pour les champs premium
        $typesAcces = [
            'gratuit' => 'Gratuit',
            'payant' => 'Payant'
        ];
        
        $dureesAcces = [
            '' => 'Sélectionner une durée',
            '24h' => '24 heures',
            '7j' => '7 jours',
            '30j' => '30 jours',
            'illimité' => 'Accès illimité'
        ];
        
        $devises = [
            'XOF' => 'Franc CFA (XOF)',
            'EUR' => 'Euro (EUR)',
            'USD' => 'Dollar US (USD)'
        ];
        
        return view('contenus.create', compact('regions', 'langues', 'typeContenus', 'auteurs', 'typesAcces', 'dureesAcces', 'devises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_auteur' => 'required|exists:utilisateurs,id_utilisateur',
            // AJOUT: Validation pour les champs premium
            'type_acces' => 'required|in:gratuit,payant',
            'prix' => 'nullable|required_if:type_acces,payant|numeric|min:0',
            'devise' => 'nullable|required_if:type_acces,payant|in:XOF,EUR,USD',
            'duree_acces' => 'nullable|string|max:50',
            'apercu' => 'nullable|string|max:1000',
        ]);

        Contenu::create([
            'titre' => $request->titre,
            'texte' => $request->texte,
            'id_region' => $request->id_region,
            'id_langue' => $request->id_langue,
            'id_type_contenu' => $request->id_type_contenu,
            'id_auteur' => $request->id_auteur,
            'date_creation' => now(),
            'statut' => 'en_attente',
            // AJOUT: Champs premium
            'type_acces' => $request->type_acces,
            'prix' => $request->prix ?? 0,
            'devise' => $request->devise ?? 'XOF',
            'est_premium' => $request->type_acces === 'payant',
            'duree_acces' => $request->duree_acces,
            'apercu' => $request->apercu,
        ]);

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu créé avec succès.');
    }

    public function show($id)
    {
        $contenu = Contenu::with(['region', 'langue', 'typeContenu', 'auteur', 'medias'])
                         ->where('id_contenu', $id)
                         ->firstOrFail();
        return view('contenus.show', compact('contenu'));
    }

    public function edit($id)
    {
        $contenu = Contenu::where('id_contenu', $id)->firstOrFail();
        $regions = Region::all();
        $langues = Langue::all();
        $typeContenus = TypeContenu::all();
        $auteurs = User::all();
        
        // AJOUT: Options pour les champs premium
        $typesAcces = [
            'gratuit' => 'Gratuit',
            'payant' => 'Payant'
        ];
        
        $dureesAcces = [
            '' => 'Sélectionner une durée',
            '24h' => '24 heures',
            '7j' => '7 jours',
            '30j' => '30 jours',
            'illimité' => 'Accès illimité'
        ];
        
        $devises = [
            'XOF' => 'Franc CFA (XOF)',
            'EUR' => 'Euro (EUR)',
            'USD' => 'Dollar US (USD)'
        ];
        
        return view('contenus.edit', compact('contenu', 'regions', 'langues', 'typeContenus', 'auteurs', 'typesAcces', 'dureesAcces', 'devises'));
    }

    public function update(Request $request, $id)
    {
        $contenu = Contenu::where('id_contenu', $id)->firstOrFail();
        
        $request->validate([
            'titre' => 'required|string|max:255',
            'texte' => 'required|string',
            'id_region' => 'required|exists:regions,id_region',
            'id_langue' => 'required|exists:langues,id_langue',
            'id_type_contenu' => 'required|exists:type_contenus,id_type_contenu',
            'id_auteur' => 'required|exists:utilisateurs,id_utilisateur',
            // AJOUT: Validation pour les champs premium
            'type_acces' => 'required|in:gratuit,payant',
            'prix' => 'nullable|required_if:type_acces,payant|numeric|min:0',
            'devise' => 'nullable|required_if:type_acces,payant|in:XOF,EUR,USD',
            'duree_acces' => 'nullable|string|max:50',
            'apercu' => 'nullable|string|max:1000',
        ]);

        $contenu->update([
            'titre' => $request->titre,
            'texte' => $request->texte,
            'id_region' => $request->id_region,
            'id_langue' => $request->id_langue,
            'id_type_contenu' => $request->id_type_contenu,
            'id_auteur' => $request->id_auteur,
            // AJOUT: Champs premium
            'type_acces' => $request->type_acces,
            'prix' => $request->prix ?? 0,
            'devise' => $request->devise ?? 'XOF',
            'est_premium' => $request->type_acces === 'payant',
            'duree_acces' => $request->duree_acces,
            'apercu' => $request->apercu,
        ]);

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $contenu = Contenu::where('id_contenu', $id)->firstOrFail();
        $contenu->delete();

        return redirect()->route('contenus.index')
            ->with('success', 'Contenu supprimé avec succès.');
    }
}