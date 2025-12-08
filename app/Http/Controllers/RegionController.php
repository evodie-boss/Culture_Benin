<?php

namespace App\Http\Controllers;

use App\Models\Region;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::with(['langues'])
                         ->withCount('contenus')
                         ->orderBy('nom_region')  // ← corrigé ici
                         ->get();

        return view('pages.regions.index', compact('regions'));
    }

    public function show(Region $region)
    {
        $region->load([
            'contenus' => fn($q) => $q->latest()->take(9),
            'langues'
        ]);

        return view('pages.regions.show', compact('region'));
    }
}