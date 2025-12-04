<?php
// filepath: /home/mightycough/Desktop/financiamiento_social/bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ===== ALIAS DE MIDDLEWARES (Route Middleware) =====
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'donante' => \App\Http\Middleware\Donante::class,
            'emprendedor' => \App\Http\Middleware\Emprendedor::class,
            'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
            'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
            'can' => \Illuminate\Auth\Middleware\Authorize::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
            'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);

        // ===== MIDDLEWARES GLOBALES (aplican a todas las rutas) =====
        $middleware->web([
            // Los middlewares web se cargan automáticamente
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Manejo de excepciones personalizadas
        $exceptions->render(function (NotFoundHttpException $e) {
            // Aquí puedes personalizar la vista 404
        });
    })
    ->create();
