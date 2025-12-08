<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// →→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→
// AJOUTE ÇA DIRECTEMENT EN DESSOUS
// →→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→→

use App\Http\Controllers\RegionController;

Route::get('/regions', [RegionController::class, 'index'])
    ->name('regions.index');

Route::get('/regions/{region}', [RegionController::class, 'show'])
    ->name('regions.show');

use App\Http\Controllers\LanguageController;

Route::get('/langues', [LanguageController::class, 'index'])->name('langues.index');
Route::get('/langues/{langue}', [LanguageController::class, 'show'])->name('langues.show');    

use App\Http\Controllers\ContenuController;

Route::get('/contenus', [ContenuController::class, 'index'])->name('contenus.index');
Route::get('/contenus/{contenu}', [ContenuController::class, 'show'])->name('contenus.show');

use App\Http\Controllers\GalleryController;

Route::get('/galeries', [GalleryController::class, 'index'])->name('galeries.index');

use App\Http\Controllers\EventController;

Route::get('/evenements', [EventController::class, 'index'])->name('evenements.index');
Route::get('/evenements/{event}', [EventController::class, 'show'])->name('evenements.show');

use App\Http\Controllers\ContributorDashboardController;

use App\Http\Controllers\ContributorRequestController;

Route::middleware('auth')->group(function () {
    Route::get('/devenir-contributeur', [ContributorRequestController::class, 'create'])
        ->name('devenir-contributeur');
    Route::post('/devenir-contributeur', [ContributorRequestController::class, 'store']);
});

// Routes pour le dashboard contributeur
Route::middleware(['auth', 'role:Contributeur'])->group(function () {
    Route::get('/contributeur/dashboard', [ContributorDashboardController::class, 'index'])
        ->name('contributor.dashboard');
});