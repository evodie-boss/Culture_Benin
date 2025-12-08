<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id_event';
    protected $fillable = [
        'titre', 'description', 'date_debut', 'date_fin', 'lieu',
        'id_region', 'type', 'prix', 'image', 'actif'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'prix' => 'decimal:2',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    public function scopeAvenir($query)
    {
        return $query->where('date_debut', '>=', now());
    }

    public function getPrixFormateAttribute()
    {
        return $this->prix > 0 ? $this->prix . ' FCFA' : 'Gratuit';
    }

    public function getDateFormateeAttribute()
    {
        return $this->date_debut->format('d M Y') . 
               ($this->date_fin ? ' → ' . $this->date_fin->format('d M Y') : '');
    }
}