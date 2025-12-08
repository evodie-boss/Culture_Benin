<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    use HasFactory;

    protected $table = 'langues';
    protected $primaryKey = 'id_langue'; // Définit la clé primaire
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nom_langue', 'code_langue', 'description'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_langue');
    }

    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_langue');
    }

    public function regions()
    {
        return $this->belongsToMany(Region::class, 'parler', 'id_langue', 'id_region');
    }
}