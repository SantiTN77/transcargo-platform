<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\NovedadCriticaRegistrada;
use App\Listeners\EnviarAlertaNovedadCritica;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        NovedadCriticaRegistrada::class => [
            EnviarAlertaNovedadCritica::class,
        ],
    ];

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
