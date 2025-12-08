<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    public function create()
    {
        return view('regions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string',
        ]);

        Region::create($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Région créée avec succès.');
    }

    public function show($id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        return view('regions.show', compact('region'));
    }

    public function edit($id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        return view('regions.edit', compact('region'));
    }

    public function update(Request $request, $id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        
        $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string',
        ]);

        $region->update($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Région mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $region = Region::where('id_region', $id)->firstOrFail();
        $region->delete();

        return redirect()->route('regions.index')
            ->with('success', 'Région supprimée avec succès.');
    }
}