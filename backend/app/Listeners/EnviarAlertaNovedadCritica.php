<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\NovedadCriticaRegistrada;
use App\Mail\AlertaNovedadCriticaMailable;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Support\Facades\Mail;

/**
 * Listener dedicado a notificar por correo las novedades críticas.
 *
 * Se apoya en la configuración `alertas.operaciones_email` para determinar el
 * destinatario sin acoplar un correo fijo en código.
 */
class EnviarAlertaNovedadCritica implements ShouldHandleEventsAfterCommit
{
    public function handle(NovedadCriticaRegistrada $event): void
    {
        $correoOperaciones = config('alertas.operaciones_email');

        if ($correoOperaciones === null) {
            return;
        }

        // El envío por correo requiere la dependencia "symfony/mailer" incluida en Laravel.
        Mail::to($correoOperaciones)->send(new AlertaNovedadCriticaMailable($event->novedad));
    }
}
