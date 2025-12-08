<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\User;
use App\Models\Contenu;
use Illuminate\Http\Request;

class CommentairesController extends Controller
{
    public function index()
    {
        $commentaires = Commentaire::with(['utilisateur', 'contenu'])->get();
        return view('commentaires.index', compact('commentaires'));
    }

    public function create()
    {
        $utilisateurs = User::all();
        $contenus = Contenu::all();
        return view('commentaires.create', compact('utilisateurs', 'contenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'texte' => 'required|string|max:1000',
            'note' => 'nullable|integer|min:1|max:5',
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'id_contenu' => 'required|exists:contenus,id_contenu',
        ]);

        Commentaire::create([
            'texte' => $request->texte,
            'note' => $request->note,
            'id_utilisateur' => $request->id_utilisateur,
            'id_contenu' => $request->id_contenu,
            'date' => now(),
        ]);

        return redirect()->route('commentaires.index')
            ->with('success', 'Commentaire créé avec succès.');
    }

    public function show($id)
    {
        $commentaire = Commentaire::with(['utilisateur', 'contenu'])
                                 ->where('id_commentaire', $id)
                                 ->firstOrFail();
        return view('commentaires.show', compact('commentaire'));
    }

    public function edit($id)
    {
        $commentaire = Commentaire::where('id_commentaire', $id)->firstOrFail();
        $utilisateurs = User::all();
        $contenus = Contenu::all();
        return view('commentaires.edit', compact('commentaire', 'utilisateurs', 'contenus'));
    }

    public function update(Request $request, $id)
    {
        $commentaire = Commentaire::where('id_commentaire', $id)->firstOrFail();
        
        $request->validate([
            'texte' => 'required|string|max:1000',
            'note' => 'nullable|integer|min:1|max:5',
            'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
            'id_contenu' => 'required|exists:contenus,id_contenu',
        ]);

        $commentaire->update($request->all());

        return redirect()->route('commentaires.index')
            ->with('success', 'Commentaire mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $commentaire = Commentaire::where('id_commentaire', $id)->firstOrFail();
        $commentaire->delete();

        return redirect()->route('commentaires.index')
            ->with('success', 'Commentaire supprimé avec succès.');
    }
}