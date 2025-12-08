<?php

namespace App\Http\Controllers;

use App\Models\Langue;

class LanguageController extends Controller
{
    public function index()
    {
        $langues = Langue::with(['regions'])
                         ->withCount('contenus')
                         ->orderBy('nom_langue')
                         ->get();

        return view('pages.langues.index', compact('langues'));
    }

    public function show(Langue $langue)
    {
        $langue->load([
            'contenus' => fn($q) => $q->where('statut', 'valide')->latest()->take(9),
            'regions'
        ]);

        return view('pages.langues.show', compact('langue'));
    }
}