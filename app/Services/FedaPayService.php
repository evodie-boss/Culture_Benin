<?php
// app/Services/FedaPayService.php

namespace App\Services;

use App\Models\Transaction;
use App\Models\Contenu;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FedaPayService
{
    private $apiKey;
    private $apiBase;
    private $webhookSecret;
    
    public function __construct()
    {
        $this->apiKey = config('services.fedapay.api_key');
        $this->apiBase = config('services.fedapay.api_base', 'https://sandbox-api.fedapay.com/v1/');
        $this->webhookSecret = config('services.fedapay.webhook_secret');
    }
    
    /**
     * Initialiser une transaction
     */
    public function initierTransaction(Contenu $contenu, User $user, array $options = [])
    {
        try {
            $reference = 'TRX-' . time() . '-' . strtoupper(uniqid());
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post($this->apiBase . 'transactions', [
                'amount' => $contenu->prix,
                'currency' => ['iso' => $contenu->devise],
                'description' => 'Achat: ' . $contenu->titre,
                'callback_url' => route('paiement.callback'),
                'customer' => [
                    'firstname' => $user->prenom,
                    'lastname' => $user->nom,
                    'email' => $user->email,
                    'phone_number' => $options['phone'] ?? null
                ],
                'metadata' => [
                    'user_id' => $user->id_utilisateur,
                    'contenu_id' => $contenu->id_contenu,
                    'reference_client' => $reference
                ]
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                // Créer la transaction en base
                $transaction = Transaction::create([
                    'id_utilisateur' => $user->id_utilisateur,
                    'id_contenu' => $contenu->id_contenu,
                    'reference_fedapay' => $data['transaction']['id'],
                    'reference_client' => $reference,
                    'montant' => $contenu->prix,
                    'devise' => $contenu->devise,
                    'statut' => 'en_attente',
                    'mode_paiement' => $options['mode_paiement'] ?? 'mobile_money',
                    'operateur' => $options['operateur'] ?? null,
                    'donnees_transaction' => $data
                ]);
                
                return [
                    'success' => true,
                    'transaction' => $transaction,
                    'payment_url' => $data['transaction']['redirect_url'] ?? null,
                    'token' => $data['transaction']['token'] ?? null
                ];
            }
            
            Log::error('FedaPay API Error', ['response' => $response->json()]);
            return ['success' => false, 'error' => 'Erreur d\'initialisation du paiement'];
            
        } catch (\Exception $e) {
            Log::error('FedaPay Service Exception', ['error' => $e->getMessage()]);
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    /**
     * Vérifier le statut d'une transaction
     */
    public function verifierTransaction(string $transactionId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->get($this->apiBase . 'transactions/' . $transactionId);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('FedaPay Verification Error', ['error' => $e->getMessage()]);
            return null;
        }
    }
    
    /**
     * Valider une signature webhook
     */
    public function validerWebhookSignature(string $signature, string $payload): bool
    {
        if (empty($this->webhookSecret)) {
            Log::warning('Webhook secret non configuré');
            return false;
        }
        
        $expectedSignature = hash_hmac('sha256', $payload, $this->webhookSecret);
        return hash_equals($expectedSignature, $signature);
    }
}
// Dans FedaPayService
Log::channel('transactions')->info('Transaction initiée', [
    'user_id' => $user->id_utilisateur,
    'contenu_id' => $contenu->id_contenu,
    'montant' => $contenu->prix,
    'reference' => $reference
]);