<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\TipoNovedadEnum;
use App\Models\Despacho;
use App\Models\NovedadDespacho;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ConsultarDespachoTest extends TestCase
{
    use RefreshDatabase;

    public function test_muestra_despacho_con_novedades(): void
    {
        $despacho = Despacho::query()->create([
            'conductor' => 'Mario Torres',
            'vehiculo' => 'CAM654',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-03'),
        ]);

        NovedadDespacho::query()->create([
            'id_despacho' => $despacho->id,
            'tipo' => TipoNovedadEnum::Transbordo->value,
            'descripcion' => 'Cambio a vehículo de apoyo',
            'fecha' => Carbon::parse('2025-11-03 12:00:00'),
        ]);

        $respuesta = $this->getJson("/api/despachos/{$despacho->id}");

        $respuesta->assertOk()
            ->assertJsonFragment([
                'id' => $despacho->id,
                'conductor' => 'Mario Torres',
                'mensaje_novedades' => null,
            ])
            ->assertJsonFragment([
                'tipo' => TipoNovedadEnum::Transbordo->value,
            ]);
    }

    public function test_informa_ausencia_de_novedades(): void
    {
        $despacho = Despacho::query()->create([
            'conductor' => 'Verónica Díaz',
            'vehiculo' => 'CAM147',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-04'),
        ]);

        $respuesta = $this->getJson("/api/despachos/{$despacho->id}");

        $respuesta->assertOk()
            ->assertJsonFragment([
                'mensaje_novedades' => 'No hay novedades registradas',
            ]);
    }
}

