<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// On enlève Sanctum pour l’instant (tu n’as pas besoin d’API tokens ici)
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'sexe',
        'date_naissance',
        'photo',
        'id_role',
        'id_langue'
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_naissance'    => 'date',
        'date_inscription'  => 'datetime',
    ];

    // Laravel attend "password" → on redirige vers mot_de_passe
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // ──────────────────────────────
    // RELATIONS
    // ──────────────────────────────
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur', 'id_utilisateur');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function contenusModeres()
    {
        return $this->hasMany(Contenu::class, 'id_moderateur', 'id_utilisateur');
    }

    // ──────────────────────────────
    // MÉTHODES UTILITAIRES POUR LES RÔLES
    // ──────────────────────────────
    public function estAdmin()
    {
        return $this->role?->nom_role === 'Administrateur';
    }

    public function estContributeur()
    {
        return $this->role?->nom_role === 'Contributeur';
    }

    public function estLecteur()
    {
        return $this->role?->nom_role === 'Lecteur';
    }

// Dans app/Models/User.php, ajoutez cette méthode :

    public function estModerateur()
    {
        return $this->role?->nom_role === 'Modérateur';
    }
}