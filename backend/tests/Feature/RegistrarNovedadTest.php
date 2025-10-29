<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\TipoNovedadEnum;
use App\Events\NovedadCriticaRegistrada;
use App\Models\Despacho;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class RegistrarNovedadTest extends TestCase
{
    use RefreshDatabase;

    public function test_registra_novedad_para_despacho_existente(): void
    {
        $despacho = Despacho::query()->create([
            'conductor' => 'Carlos Ruiz',
            'vehiculo' => 'CAM999',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-01'),
        ]);

        $respuesta = $this->postJson('/api/novedades', [
            'id_despacho' => $despacho->id,
            'tipo' => TipoNovedadEnum::Retraso->value,
            'descripcion' => 'Retraso por mantenimiento vial',
            'fecha' => '2025-11-01 09:30:00',
        ]);

        $respuesta->assertCreated()
            ->assertJsonFragment([
                'tipo' => TipoNovedadEnum::Retraso->value,
                'descripcion' => 'Retraso por mantenimiento vial',
            ]);

        $this->assertDatabaseHas('novedades', [
            'id_despacho' => $despacho->id,
            'tipo' => TipoNovedadEnum::Retraso->value,
        ]);
    }

    public function test_rechaza_tipo_de_novedad_invalido(): void
    {
        $despacho = Despacho::query()->create([
            'conductor' => 'Andrea Silva',
            'vehiculo' => 'CAM321',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-02'),
        ]);

        $respuesta = $this->postJson('/api/novedades', [
            'id_despacho' => $despacho->id,
            'tipo' => 'Visita',
            'descripcion' => 'Dato no válido',
            'fecha' => '2025-11-02 10:00:00',
        ]);

        $respuesta->assertUnprocessable()
            ->assertJsonValidationErrors(['tipo']);
    }

    public function test_dispara_evento_al_registrar_novedad_critica(): void
    {
        Event::fake([NovedadCriticaRegistrada::class]);

        $despacho = Despacho::query()->create([
            'conductor' => 'Laura Páez',
            'vehiculo' => 'CAM852',
            'estado' => 'En ruta',
            'fecha' => Carbon::parse('2025-11-06'),
        ]);

        $this->postJson('/api/novedades', [
            'id_despacho' => $despacho->id,
            'tipo' => TipoNovedadEnum::Dano->value,
            'descripcion' => 'Daño en la carga',
            'fecha' => '2025-11-06 14:30:00',
        ])->assertCreated();

        Event::assertDispatched(NovedadCriticaRegistrada::class);
    }
}

