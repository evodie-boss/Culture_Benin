<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Admin a accès à tout
        if ($user->estAdmin()) {
            return $next($request);
        }

        // Sinon on vérifie le rôle exact
        if ($user->role?->nom_role === $role) {
            return $next($request);
        }

        // Accès refusé
        return redirect('/')->with('error', 'Accès refusé');
    }
}