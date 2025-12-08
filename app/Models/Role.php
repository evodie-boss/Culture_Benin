<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Nom de la table
    protected $table = 'roles';

    // Clé primaire correcte
    protected $primaryKey = 'id_role';

    // Si ta clé primaire n'est pas auto-incrémentée, enlève cette ligne
    public $incrementing = true;

    // Type de la clé primaire
    protected $keyType = 'int';

    // Colonnes modifiables
    protected $fillable = [
        'nom_role',
        'description',
    ];

    // Relation avec utilisateurs
    public function utilisateurs()
    {
        return $this->hasMany(User::class, 'id_role', 'id_role');
    }
}
