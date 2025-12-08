<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        // Si déjà connecté → on redirige
        if (Auth::check()) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:utilisateurs'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Rôle "Lecteur" par défaut
        $roleLecteur = Role::where('nom_role', 'Lecteur')->firstOrFail()->id_role;

        $user = User::create([
            'nom'               => $request->name,
            'email'             => $request->email,
            'mot_de_passe'     => Hash::make($request->password),
            'id_role'           => $roleLecteur,
            'date_inscription'  => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/'); // → ton beau welcome
    }
}