<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\TypeContenusController;
use App\Http\Controllers\TypeMediasController;
use App\Http\Controllers\ContenusController;
use App\Http\Controllers\MediasController;
use App\Http\Controllers\CommentairesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DemandeContributeurController;

// PROTECTION ADMIN : seul un utilisateur avec le rôle "Administrateur" peut accéder
Route::prefix('admin')
    ->middleware(['auth', 'role:Administrateur'])
    ->as('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('langues', LanguesController::class);
        Route::resource('roles', RolesController::class);
        Route::resource('regions', RegionsController::class);
        Route::resource('type-contenus', TypeContenusController::class);
        Route::resource('type-medias', TypeMediasController::class);
        Route::resource('contenus', ContenusController::class);
        Route::resource('medias', MediasController::class);
        Route::resource('commentaires', CommentairesController::class);
        Route::resource('users', UsersController::class);

        // Routes pour les demandes contributeur
        Route::prefix('demandes')->name('demandes.')->group(function () {
            Route::get('/', [DemandeContributeurController::class, 'index'])->name('index');
            Route::get('/{id}', [DemandeContributeurController::class, 'show'])->name('show');
            Route::post('/{id}/valider', [DemandeContributeurController::class, 'valider'])->name('valider');
            Route::post('/{id}/refuser', [DemandeContributeurController::class, 'refuser'])->name('refuser');
            Route::get('/historique', [DemandeContributeurController::class, 'historique'])->name('historique');
        });
    });