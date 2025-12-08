<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenusController extends Controller
{
    public function index()
    {
        $typeContenus = TypeContenu::all();
        return view('type_contenus.index', compact('typeContenus'));
    }

    public function create()
    {
        return view('type_contenus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_contenu' => 'required|string|max:255|unique:type_contenus',
        ]);

        TypeContenu::create($request->all());

        return redirect()->route('type-contenus.index')
            ->with('success', 'Type de contenu créé avec succès.');
    }

    public function show($id)
    {
        $typeContenu = TypeContenu::where('id_type_contenu', $id)->firstOrFail();
        return view('type_contenus.show', compact('typeContenu'));
    }

    public function edit($id)
    {
        $typeContenu = TypeContenu::where('id_type_contenu', $id)->firstOrFail();
        return view('type_contenus.edit', compact('typeContenu'));
    }

    public function update(Request $request, $id)
    {
        $typeContenu = TypeContenu::where('id_type_contenu', $id)->firstOrFail();
        
        $request->validate([
            'nom_contenu' => 'required|string|max:255|unique:type_contenus,nom_contenu,' . $typeContenu->id_type_contenu . ',id_type_contenu',
        ]);

        $typeContenu->update($request->all());

        return redirect()->route('type-contenus.index')
            ->with('success', 'Type de contenu mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $typeContenu = TypeContenu::where('id_type_contenu', $id)->firstOrFail();
        $typeContenu->delete();

        return redirect()->route('type-contenus.index')
            ->with('success', 'Type de contenu supprimé avec succès.');
    }
}