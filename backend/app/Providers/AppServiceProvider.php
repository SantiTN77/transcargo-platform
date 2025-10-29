<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registrar bindings de la aplicación.
    }

    public function boot(): void
    {
        // Configuraciones al arrancar la aplicación.
    }
}
