<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,  // Si vous avez un middleware Admin
            'role' => \App\Http\Middleware\CheckRole::class,  // AJOUTEZ CETTE LIGNE
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'premium.access' => \App\Http\Middleware\CheckPremiumAccess::class,
    ]);
})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

    