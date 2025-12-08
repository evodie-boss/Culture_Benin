<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';
    protected $primaryKey = 'id_region';
    public $incrementing = true;
    protected $keyType = 'int';

    // CORRIGE LES FILLABLE POUR INCLURE TOUS LES CHAMPS
    protected $fillable = [
        'nom_region', 
        'description', 
        'population', 
        'superficie', 
        'localisation'
    ];

    public function langues()
    {
        return $this->belongsToMany(Langue::class, 'parler', 'id_region', 'id_langue');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_region');
    }
}