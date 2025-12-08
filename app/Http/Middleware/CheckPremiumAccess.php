<?php
// app/Http/Middleware/CheckPremiumAccess.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Contenu;

class CheckPremiumAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $contenu = $request->route('contenu');
        
        // Si le contenu n'est pas premium, continuer
        if (!$contenu || !$contenu->est_premium || $contenu->type_acces !== 'payant') {
            return $next($request);
        }
        
        // Vérifier l'accès utilisateur
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter pour accéder à ce contenu premium.');
        }
        
        if (!$contenu->utilisateurAAcces($user)) {
            return redirect()->route('contenus.show', $contenu)
                ->with('info', 'Ce contenu est premium. Veuillez l\'acheter pour y accéder.');
        }
        
        return $next($request);
    }
}