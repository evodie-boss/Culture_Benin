<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';
    protected $primaryKey = 'id_media';

    protected $fillable = [
        'chemin',
        'description',
        'id_contenu',
        'id_type_media',
        'nom_original',
        'taille',
        'mime_type'
    ];

    // ──────────────────────────────
    // CONSTANTES TYPES DE MÉDIAS
    // ──────────────────────────────
    const TYPE_IMAGE = 1;
    const TYPE_AUDIO = 2;
    const TYPE_VIDEO = 3;
    const TYPE_PDF   = 4;

    // ──────────────────────────────
    // RELATIONS
    // ──────────────────────────────
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }

    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type_media');
    }

    // ──────────────────────────────
    // ACCESSEURS ULTRA IMPORTANTS
    // ──────────────────────────────

    /**
     * URL publique du fichier (utilisé partout : galeries, contenus, admin…)
     * Exemple : http://localhost/cultureVraiFin/public/storage/medias/photo.jpg
     */
    public function getUrlAttribute()
    // ← $media->url
    {
        if (!$this->chemin) {
            return null;
        }
        return asset('storage/' . $this->chemin);
    }

    /**
     * Chemin absolu sur le disque (utile pour suppression, vérification…)
     */
    public function getCheminCompletAttribute()
    {
        return storage_path('app/public/' . $this->chemin);
    }

    /**
     * Icône FontAwesome selon le type
     */
    public function getIconeAttribute()
    {
        return match ($this->id_type_media) {
            self::TYPE_IMAGE => 'fas fa-image',
            self::TYPE_AUDIO => 'fas fa-music',
            self::TYPE_VIDEO => 'fas fa-video',
            self::TYPE_PDF   => 'fas fa-file-pdf',
            default          => 'fas fa-file',
        };
    }

    /**
     * Taille formatée lisible
     */
    public function getTailleFormateeAttribute()
    {
        if ($this->taille >= 1048576) {
            return number_format($this->taille / 1048576, 2) . ' MB';
        }
        if ($this->taille >= 1024) {
            return number_format($this->taille / 1024, 2) . ' KB';
        }
        return $this->taille . ' bytes';
    }

    // ──────────────────────────────
    // SCOPES
    // ──────────────────────────────
    public function scopeParType($query, $typeId)
    {
        return $query->where('id_type_media', $typeId);
    }

    public function scopeAvecContenuValide($query)
    {
        return $query->whereHas('contenu', fn($q) => $q->where('statut', 'validé'));
    }
}