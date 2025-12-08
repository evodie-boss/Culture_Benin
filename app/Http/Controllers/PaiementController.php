<?php
// app/Http/Controllers/PaiementController.php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Transaction;
use App\Services\FedaPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaiementController extends Controller
{
    protected $fedaPayService;
    
    public function __construct(FedaPayService $fedaPayService)
    {
        $this->fedaPayService = $fedaPayService;
        $this->middleware('auth');
    }
    
    /**
     * Afficher le formulaire de paiement
     */
    public function show(Contenu $contenu)
    {
        // Vérifier si le contenu est payant
        if (!$contenu->est_premium || $contenu->type_acces !== 'payant') {
            return redirect()->route('contenus.show', $contenu)
                ->with('info', 'Ce contenu est gratuit.');
        }
        
        // Vérifier si l'utilisateur a déjà accès
        if ($contenu->utilisateurAAcces(Auth::user())) {
            return redirect()->route('contenus.premium', $contenu);
        }
        
        return view('paiement.show', compact('contenu'));
    }
    
    /**
     * Initialiser un paiement
     */
    public function initier(Contenu $contenu, Request $request)
    {
        $request->validate([
            'operateur' => 'required|in:MTN,Moov',
            'phone' => 'required|regex:/^[0-9]{8,}$/'
        ]);
        
        $user = Auth::user();
        
        // Vérifier si une transaction est déjà en cours
        $transactionEnCours = Transaction::where('id_utilisateur', $user->id_utilisateur)
            ->where('id_contenu', $contenu->id_contenu)
            ->where('statut', 'en_attente')
            ->where('created_at', '>', now()->subMinutes(30))
            ->first();
            
        if ($transactionEnCours) {
            return redirect()->away($transactionEnCours->donnees_transaction['transaction']['redirect_url'] ?? '#');
        }
        
        // Initialiser la transaction
        $result = $this->fedaPayService->initierTransaction($contenu, $user, [
            'operateur' => $request->operateur,
            'phone' => $request->phone,
            'mode_paiement' => 'mobile_money'
        ]);
        
        if ($result['success'] && $result['payment_url']) {
            return redirect()->away($result['payment_url']);
        }
        
        return back()->withErrors(['error' => $result['error'] ?? 'Échec de l\'initialisation du paiement']);
    }
    
    /**
     * Callback après paiement
     */
    public function callback(Request $request)
    {
        $transactionId = $request->query('transaction_id');
        
        if (!$transactionId) {
            return redirect()->route('contenus.index')
                ->with('error', 'Transaction introuvable.');
        }
        
        // Vérifier le statut chez FedaPay
        $status = $this->fedaPayService->verifierTransaction($transactionId);
        
        if (!$status) {
            return redirect()->route('contenus.index')
                ->with('error', 'Impossible de vérifier le statut du paiement.');
        }
        
        // Trouver la transaction en base
        $transaction = Transaction::where('reference_fedapay', $transactionId)->first();
        
        if (!$transaction) {
            return redirect()->route('contenus.index')
                ->with('error', 'Transaction introuvable dans notre système.');
        }
        
        // Mettre à jour le statut
        $transactionStatut = $status['transaction']['status'];
        
        if ($transactionStatut === 'approved') {
            $transaction->update([
                'statut' => 'payee',
                'date_paiement' => now(),
                'donnees_webhook' => $status
            ]);
            
            // Calculer la date d'expiration si applicable
            if ($transaction->contenu->duree_acces) {
                $expireLe = $this->calculerDateExpiration($transaction->contenu->duree_acces);
                $transaction->update(['expire_le' => $expireLe]);
            }
            
            return redirect()->route('contenus.premium', $transaction->contenu)
                ->with('success', 'Paiement effectué avec succès !');
        }
        
        $transaction->update([
            'statut' => 'echouee',
            'donnees_webhook' => $status
        ]);
        
        return redirect()->route('contenus.show', $transaction->contenu)
            ->with('error', 'Le paiement a échoué. Veuillez réessayer.');
    }
    
    /**
     * Webhook pour les notifications FedaPay
     */
    public function webhook(Request $request)
    {
        $signature = $request->header('X-FedaPay-Signature');
        $payload = $request->getContent();
        
        // Valider la signature
        if (!$this->fedaPayService->validerWebhookSignature($signature, $payload)) {
            Log::warning('Webhook signature invalide', ['ip' => $request->ip()]);
            abort(400, 'Signature invalide');
        }
        
        $data = json_decode($payload, true);
        $event = $data['event'] ?? null;
        $transactionId = $data['data']['id'] ?? null;
        
        if ($event === 'transaction.approved' && $transactionId) {
            $this->traiterTransactionApprouvee($transactionId, $data);
        }
        
        return response()->json(['status' => 'received']);
    }
    
    /**
     * Traiter une transaction approuvée
     */
    private function traiterTransactionApprouvee(string $transactionId, array $data)
    {
        $transaction = Transaction::where('reference_fedapay', $transactionId)->first();
        
        if ($transaction && $transaction->statut === 'en_attente') {
            $transaction->update([
                'statut' => 'payee',
                'date_paiement' => now(),
                'donnees_webhook' => $data
            ]);
            
            Log::info('Transaction approuvée via webhook', [
                'transaction_id' => $transactionId,
                'user_id' => $transaction->id_utilisateur
            ]);
        }
    }
    
    /**
     * Calculer la date d'expiration
     */
    private function calculerDateExpiration(string $duree): \DateTime
    {
        $now = now();
        
        switch ($duree) {
            case '24h':
                return $now->addDay();
            case '7j':
                return $now->addWeek();
            case '30j':
                return $now->addMonth();
            default:
                return $now->addYear(); // Par défaut 1 an
        }
    }
}