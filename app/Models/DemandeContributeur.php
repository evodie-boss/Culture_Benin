<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeContributeur extends Model
{
    protected $table = 'demandes_contributeur';
    protected $primaryKey = 'id_demande'; // Ajouter cette ligne

    protected $fillable = [
        'id_utilisateur', 
        'message', 
        'statut', 
        'traitee_le',
        'commentaire_admin', // Ajouter
        'traitee_par' // Ajouter
    ];

    protected $casts = [
        'traitee_le' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function adminTraitant()
    {
        return $this->belongsTo(User::class, 'traitee_par', 'id_utilisateur');
    }

    // Scopes utiles
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeValidees($query)
    {
        return $query->where('statut', 'validée');
    }

    public function scopeRefusees($query)
    {
        return $query->where('statut', 'refusée');
    }
}