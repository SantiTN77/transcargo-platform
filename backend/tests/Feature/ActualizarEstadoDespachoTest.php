<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Despacho;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ActualizarEstadoDespachoTest extends TestCase
{
    use RefreshDatabase;

    public function test_actualiza_estado_y_guarda_historial(): void
    {
        $despacho = Despacho::query()->create([
            'conductor' => 'César León',
            'vehiculo' => 'CAM963',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-08'),
        ]);

        $respuesta = $this->putJson("/api/despachos/{$despacho->id}/estado", [
            'estado' => 'Entregado',
        ]);

        $respuesta->assertOk()
            ->assertJsonFragment([
                'id' => $despacho->id,
                'estado' => 'Entregado',
            ]);

        $this->assertDatabaseHas('despachos', [
            'id' => $despacho->id,
            'estado' => 'Entregado',
        ]);

        $this->assertDatabaseHas('historial_estados_despacho', [
            'id_despacho' => $despacho->id,
            'estado_anterior' => 'En ruta',
            'estado_nuevo' => 'Entregado',
        ]);
    }

    public function test_rechaza_estado_invalido(): void
    {
        $despacho = Despacho::query()->create([
            'conductor' => 'Diana López',
            'vehiculo' => 'CAM357',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-09'),
        ]);

        $respuesta = $this->putJson("/api/despachos/{$despacho->id}/estado", [
            'estado' => 'En pausa',
        ]);

        $respuesta->assertUnprocessable()
            ->assertJsonValidationErrors(['estado']);
    }
}
