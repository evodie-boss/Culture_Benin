<?php

namespace App\Http\Controllers;

use App\Models\Media;

class GalleryController extends Controller
{
    public function index()
{
    // Chercher l'ID du type "image" dynamiquement
    $imageType = \App\Models\TypeMedia::where('nom_media', 'like', '%image%')
                                      ->orWhere('nom_media', 'like', '%photo%')
                                      ->first();
    
    $photos = Media::when($imageType, function($query) use ($imageType) {
                        return $query->where('id_type_media', $imageType->id);
                    })
                   ->where(function($query) {
                       $query->where('chemin', 'like', '%.jpg%')
                             ->orWhere('chemin', 'like', '%.jpeg%')
                             ->orWhere('chemin', 'like', '%.png%')
                             ->orWhere('chemin', 'like', '%.webp%');
                   })
                   ->with(['contenu.region', 'typeMedia'])
                   ->latest()
                   ->paginate(12);

    return view('pages.galeries.index', compact('photos'));
}
}