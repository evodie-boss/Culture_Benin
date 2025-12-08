<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    // Liste des utilisateurs
    public function index()
    {
        // On récupère tous les utilisateurs avec leur rôle et langue associés
        $users = User::with(['role', 'langue'])->get();

        return view('users.index', compact('users'));
    }

    // Formulaire de création
    public function create()
    {
        $roles = Role::all();
        $langues = Langue::all();
        return view('users.create', compact('roles', 'langues'));
    }

    // Stocker un nouvel utilisateur
    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users','email')],
            'password' => 'required|string|min:6|confirmed',
            'sexe' => 'required|string|max:1',
            'date_naissance' => 'nullable|date',
            'statut' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:2048',
            'telephone' => 'nullable|string|max:20',

            'id_role' => 'required|integer|exists:roles,id_role',
            'id_langue' => 'nullable|integer|exists:langues,id_langue',
        ]);

        // Hash du mot de passe
        $validated['mot_de_passe'] = Hash::make($validated['password']);
        unset($validated['password'], $validated['password_confirmation']);

        // Stocker la photo si présente
        if($request->hasFile('photo')){
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    // Afficher un utilisateur
    public function show($id)
    {
        $user = User::with(['role', 'langue'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Formulaire d'édition
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $langues = Langue::all();
        return view('users.edit', compact('user', 'roles', 'langues'));
    }

    // Mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('users','email')->ignore($id)],
            'mot_de_passe' => 'nullable|string|min:6|confirmed',
            'sexe' => 'required|string|max:1',
            'date_naissance' => 'nullable|date',
            'statut' => 'nullable|string|max:50',
            'photo' => 'nullable|image|max:2048',

            'id_role' => 'required|integer|exists:roles,id_role',
            'id_langue' => 'nullable|integer|exists:langues,id_langue',
        ]);

        // Gestion du mot de passe
        if (!empty($validated['mot_de_passe'])) {
            $validated['mot_de_passe'] = Hash::make($validated['mot_de_passe']);
        } else {
            unset($validated['mot_de_passe']);
        }

        // Photo
        if($request->hasFile('photo')){
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès !');
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès !');
    }
}
