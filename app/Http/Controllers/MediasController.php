<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Contenu;
use App\Models\TypeMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediasController extends Controller
{
    public function index()
    {
        $medias = Media::with(['contenu', 'typeMedia'])->latest()->get();
        return view('medias.index', compact('medias'));
    }

    public function create()
    {
        $contenus = Contenu::all();
        $typeMedias = TypeMedia::all();
        return view('medias.create', compact('contenus', 'typeMedias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fichier'        => 'required|file|max:51200', // 50MB max
            'description'    => 'nullable|string',
            'id_contenu'     => 'required|exists:contenus,id_contenu',
            'id_type_media'  => 'required|exists:type_medias,id_type_media',
        ]);

        if ($request->hasFile('fichier') && $request->file('fichier')->isValid()) {
            $file = $request->file('fichier');
            $path = $file->store('medias', 'public'); // → storage/app/public/medias/nom.jpg

            Media::create([
                'chemin'         => $path,
                'description'    => $request->description,
                'id_contenu'     => $request->id_contenu,
                'id_type_media'  => $request->id_type_media,
                'nom_original'   => $file->getClientOriginalName(),
                'taille'         => $file->getSize(),
                'mime_type'      => $file->getMimeType(),
            ]);
        }

        return redirect()->route('medias.index')
            ->with('success', 'Média uploadé avec succès !');
    }

    public function edit($id)
    {
        $media = Media::findOrFail($id);
        $contenus = Contenu::all();
        $typeMedias = TypeMedia::all();
        return view('medias.edit', compact('media', 'contenus', 'typeMedias'));
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'fichier'        => 'nullable|file|max:51200',
            'description'    => 'nullable|string',
            'id_contenu'     => 'required|exists:contenus,id_contenu',
            'id_type_media'  => 'required|exists:type_medias,id_type_media',
        ]);

        $data = $request->only(['description', 'id_contenu', 'id_type_media']);

        if ($request->hasFile('fichier') && $request->file('fichier')->isValid()) {
            // Supprime l'ancien fichier
            if ($media->chemin) {
                Storage::disk('public')->delete($media->chemin);
            }

            $file = $request->file('fichier');
            $path = $file->store('medias', 'public');

            $data['chemin']        = $path;
            $data['nom_original']  = $file->getClientOriginalName();
            $data['taille']        = $file->getSize();
            $data['mime_type']     = $file->getMimeType();
        }

        $media->update($data);

        return redirect()->route('medias.index')
            ->with('success', 'Média mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        if ($media->chemin) {
            Storage::disk('public')->delete($media->chemin);
        }
        $media->delete();

        return redirect()->route('medias.index')
            ->with('success', 'Média supprimé définitivement.');
    }

    public function show($id)
    {
        $media = Media::with(['contenu', 'typeMedia'])->findOrFail($id);
        return view('medias.show', compact('media'));
    }
}