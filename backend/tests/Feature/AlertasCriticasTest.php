<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Events\NovedadCriticaRegistrada;
use App\Listeners\EnviarAlertaNovedadCritica;
use App\Mail\AlertaNovedadCriticaMailable;
use App\Models\Despacho;
use App\Models\NovedadDespacho;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AlertasCriticasTest extends TestCase
{
    use RefreshDatabase;

    public function test_listener_envia_correo_a_operaciones(): void
    {
        Mail::fake();
        config(['alertas.operaciones_email' => 'operaciones@transcargo.test']);

        $despacho = Despacho::query()->create([
            'conductor' => 'Alicia Ortega',
            'vehiculo' => 'CAM741',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-07'),
        ]);

        $novedad = NovedadDespacho::query()->create([
            'id_despacho' => $despacho->id,
            'tipo' => 'Daño',
            'descripcion' => 'Daño detectado en bultos',
            'fecha' => Carbon::parse('2025-11-07 08:45:00'),
        ]);

        $novedad->setRelation('despacho', $despacho);

        $listener = new EnviarAlertaNovedadCritica();
        $listener->handle(new NovedadCriticaRegistrada($novedad));

        Mail::assertSent(AlertaNovedadCriticaMailable::class, function (AlertaNovedadCriticaMailable $mailable): bool {
            return $mailable->hasTo('operaciones@transcargo.test');
        });
    }
}
