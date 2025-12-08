<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaiementController;
use Illuminate\Support\Facades\Route;

// 1. IMPORTER LE NOUVEAU CONTROLLER D'ADMINISTRATION
use App\Http\Controllers\AdminController;


// ===========================================
// ROUTES PUBLIQUES & UTILISATEUR (FRONTEND)
// ===========================================

// Route SPLASH SCREEN (Animation 5s avec drapeau du Bénin)
Route::get('/', function () {
    return view('splash');
})->name('splash');

// Route de la page d'accueil principale (Le site public)
Route::get('/home', function () {
    return view('welcome');
})->name('home');

// Redirection pour garder la compatibilité
Route::redirect('/welcome', '/home');


// Dashboard Utilisateur (nécessite d'être connecté)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// ===========================================
// ROUTES PAIEMENT FEDAPAY
// ===========================================

// Routes de paiement
Route::middleware(['auth'])->prefix('paiement')->group(function () {
    Route::get('/contenu/{contenu}', [PaiementController::class, 'show'])->name('paiement.show');
    Route::post('/contenu/{contenu}/initier', [PaiementController::class, 'initier'])->name('paiement.initier');
    Route::get('/callback', [PaiementController::class, 'callback'])->name('paiement.callback');
});

// Webhook FedaPay (sans middleware CSRF)
Route::withoutMiddleware(['web'])->post('/webhook/fedapay', [PaiementController::class, 'webhook']);

// Routes contenus premium
Route::middleware(['auth'])->group(function () {
    Route::get('/contenus/{contenu}/premium', [App\Http\Controllers\ContenuController::class, 'premium'])->name('contenus.premium');
});


// ===========================================
// REDIRECTION ADMIN (optionnel)
// ===========================================

// Si vous voulez que /admin redirige vers le dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});


// ===========================================
// AUTRES ROUTES
// ===========================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CORRECTION ICI : __DIR__ avec DEUX underscores
require __DIR__.'/auth.php';
require __DIR__.'/admin.php'; 
require __DIR__.'/front.php';