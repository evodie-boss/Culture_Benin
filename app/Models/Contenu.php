<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contenu extends Model
{
    use HasFactory;

    protected $table = 'contenus';
    protected $primaryKey = 'id_contenu';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'titre', 'texte', 'date_creation', 'statut', 'parent_id',
        'date_validation', 'id_region', 'id_langue', 'id_moderateur',
        'id_type_contenu', 'id_auteur',
        // NOUVEAUX CHAMPS
        'type_acces', 'prix', 'devise', 'est_premium', 'duree_acces', 'apercu'
    ];

    protected $casts = [
        'date_creation' => 'datetime',
        'date_validation' => 'datetime',
        // NOUVEAUX CASTS
        'prix' => 'decimal:2',
        'est_premium' => 'boolean'
    ];

    // Relations
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function typeContenu()
    {
        return $this->belongsTo(TypeContenu::class, 'id_type_contenu');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'id_auteur');
    }

    public function moderateur()
    {
        return $this->belongsTo(User::class, 'id_moderateur');
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'id_contenu');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_contenu');
    }

    public function traductions()
    {
        return $this->hasMany(Contenu::class, 'parent_id');
    }

    public function contenuOriginal()
    {
        return $this->belongsTo(Contenu::class, 'parent_id');
    }

    // NOUVELLE RELATION
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id_contenu');
    }

    // NOUVELLES MÉTHODES
    
    /**
     * Vérifie si l'utilisateur a accès à ce contenu
     */
    // Dans app/Models/Contenu.php, remplacez la méthode utilisateurAAcces par :

public function utilisateurAAcces($user = null): bool
{
    // Si le contenu est gratuit
    if ($this->type_acces === 'gratuit') {
        return true;
    }
    
    // Si pas d'utilisateur connecté
    if (!$user) {
        return false;
    }
    
    // Si l'utilisateur est admin ou modérateur
    if ($user->estAdmin() || $user->estModerateur()) {
        return true;
    }
    
    // Vérifier si l'utilisateur a une transaction valide
    return $this->transactions()
        ->where('id_utilisateur', $user->id_utilisateur)
        ->where('statut', 'payee')
        ->where(function($query) {
            $query->whereNull('expire_le')
                  ->orWhere('expire_le', '>', now());
        })
        ->exists();
}
    /**
     * Récupère l'aperçu du contenu
     */
    public function getApercuAttribute($value)
    {
        if ($this->est_premium && !empty($value)) {
            return $value;
        }
        
        // Pour les contenus gratuits ou sans aperçu
        return Str::limit(strip_tags($this->texte), 200);
    }

    /**
     * Scope pour les contenus gratuits
     */
    public function scopeGratuit($query)
    {
        return $query->where('type_acces', 'gratuit');
    }

    /**
     * Scope pour les contenus payants
     */
    public function scopePayant($query)
    {
        return $query->where('type_acces', 'payant');
    }

    /**
     * Scope pour les contenus premium
     */
    public function scopePremium($query)
    {
        return $query->where('est_premium', true);
    }
}