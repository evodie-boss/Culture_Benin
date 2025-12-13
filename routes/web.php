<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// ===========================================
// ROUTES PUBLIQUES
// ===========================================

Route::get('/', function () {
    return view('splash');
})->name('splash');

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::redirect('/welcome', '/home');

// ===========================================
// ROUTES PAIEMENT
// ===========================================

Route::middleware(['auth'])->prefix('paiement')->group(function () {
    Route::get('/contenu/{contenu}', [PaiementController::class, 'show'])->name('paiement.show');
    Route::post('/contenu/{contenu}/initier', [PaiementController::class, 'initier'])->name('paiement.initier');
    Route::get('/callback', [PaiementController::class, 'callback'])->name('paiement.callback');
});

Route::withoutMiddleware(['web'])->post('/webhook/fedapay', [PaiementController::class, 'webhook']);

// ===========================================
// ROUTES AUTH
// ===========================================

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/contenus/{contenu}/premium', [App\Http\Controllers\ContenuController::class, 'premium'])->name('contenus.premium');
});

// ===========================================
// ROUTES ADMIN (EXPLICITES)
// ===========================================

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('admin.redirect');

// ===========================================
// INCLUSIONS
// ===========================================

require __DIR__.'/auth.php';
require __DIR__.'/admin.php'; 
require __DIR__.'/front.php';