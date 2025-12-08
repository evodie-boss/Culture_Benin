<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['texte', 'note', 'date', 'id_utilisateur', 'id_contenu'];

    // AJOUTE LES CASTS POUR CONVERTIR LA DATE
    protected $casts = [
        'date' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }
}