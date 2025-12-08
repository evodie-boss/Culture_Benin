<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Utilisateur;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $email = $request->input('email');
        $plainPassword = $request->input('password');
        $remember = $request->boolean('remember');

        $user = Utilisateur::where('email', $email)->first();

        if (!$user || !Hash::check($plainPassword, $user->mot_de_passe)) {
            return back()->withErrors(['email' => 'Ces identifiants ne correspondent pas à nos enregistrements.'])->onlyInput('email');
        }

        Auth::login($user, $remember);
        $request->session()->regenerate();

        // Redirection selon rôle
        $roleName = strtolower($user->role->nom_role ?? '');

        if ($roleName === 'admin' || $roleName === 'administrateur') {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
