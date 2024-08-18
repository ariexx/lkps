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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'dashboard-redirect' => App\Http\Middleware\DashboardRedirectMiddleware::class,
            'is-authenticated' => App\Http\Middleware\IsAuthenticatedMiddleware::class,
            'role-check' => App\Http\Middleware\RoleCheckMiddleware::class,
            'prodi-or-admin-prodi' => App\Http\Middleware\CheckProdiOrAdminProdiMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
