<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: __DIR__.'/../routes/health.php'
    )
    ->withMiddleware(function (Application $app) {
        // Mantener configuración por defecto de middleware mediante archivos del núcleo.
    })
    ->withExceptions(function (Application $app) {
        // Se utilizan los manejadores predeterminados de Laravel.
    });
