<?php
// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id_transaction';
    
    protected $fillable = [
        'id_utilisateur', // CORRIGÉ
        'id_contenu', // CORRIGÉ
        'reference_fedapay',
        'reference_client',
        'montant',
        'devise',
        'statut',
        'mode_paiement',
        'operateur',
        'donnees_transaction',
        'donnees_webhook',
        'date_paiement',
        'expire_le'
    ];
    
    protected $casts = [
        'montant' => 'decimal:2',
        'donnees_transaction' => 'array',
        'donnees_webhook' => 'array',
        'date_paiement' => 'datetime',
        'expire_le' => 'datetime'
    ];
    
    /**
     * Relation avec l'utilisateur
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur'); // CORRIGÉ
    }
    
    /**
     * Relation avec le contenu
     */
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu'); // CORRIGÉ
    }
    
    /**
     * Vérifie si la transaction est payée et valide
     */
    public function estValide(): bool
    {
        return $this->statut === 'payee' && 
               (!$this->expire_le || $this->expire_le > now());
    }
    
    /**
     * Vérifie si la transaction a expiré
     */
    public function estExpiree(): bool
    {
        return $this->expire_le && $this->expire_le <= now();
    }
    
    /**
     * Scope pour les transactions payées
     */
    public function scopePayees($query)
    {
        return $query->where('statut', 'payee');
    }
    
    /**
     * Scope pour les transactions en attente
     */
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }
}