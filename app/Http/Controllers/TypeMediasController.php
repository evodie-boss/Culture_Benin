<?php

namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;

class TypeMediasController extends Controller
{
    public function index()
    {
        $typeMedias = TypeMedia::all();
        return view('type_medias.index', compact('typeMedias'));
    }

    public function create()
    {
        return view('type_medias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_media' => 'required|string|max:255|unique:type_medias',
        ]);

        TypeMedia::create($request->all());
        return redirect()->route('type-medias.index')->with('success', 'Type de média créé avec succès.');
    }

    public function show(TypeMedia $typeMedia)
    {
        return view('type_medias.show', compact('typeMedia'));
    }

    public function edit(TypeMedia $typeMedia)
    {
        return view('type_medias.edit', compact('typeMedia'));
    }

    public function update(Request $request, TypeMedia $typeMedia)
    {
        $request->validate([
            'nom_media' => 'required|string|max:255|unique:type_medias,nom_media,' . $typeMedia->id_type_media . ',id_type_media',
        ]);

        $typeMedia->update($request->all());
        return redirect()->route('type-medias.index')->with('success', 'Type de média mis à jour avec succès.');
    }

    public function destroy(TypeMedia $typeMedia)
    {
        $typeMedia->delete();
        return redirect()->route('type-medias.index')->with('success', 'Type de média supprimé avec succès.');
    }
}