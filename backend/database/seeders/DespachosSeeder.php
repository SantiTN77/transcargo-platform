<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\TipoNovedadEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DespachosSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            DB::table('despachos')->truncate();
            DB::table('novedades')->truncate();

            $despachos = [
                [
                    'id' => 1,
                    'conductor' => 'Juan Pérez',
                    'vehiculo' => 'CAM123',
                    'estado' => 'En ruta',
                    'fecha' => Carbon::parse('2025-10-10'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 2,
                    'conductor' => 'Ana Gómez',
                    'vehiculo' => 'CAM456',
                    'estado' => 'Entregado',
                    'fecha' => Carbon::parse('2025-10-10'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => 3,
                    'conductor' => 'Luis Díaz',
                    'vehiculo' => 'CAM789',
                    'estado' => 'En ruta',
                    'fecha' => Carbon::parse('2025-10-11'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            DB::table('despachos')->insert($despachos);

            DB::table('novedades')->insert([
                [
                    'id_despacho' => 1,
                    'tipo' => TipoNovedadEnum::Retraso->value,
                    'descripcion' => 'Tráfico intenso',
                    'fecha' => Carbon::parse('2025-10-10 08:00:00'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_despacho' => 3,
                    'tipo' => TipoNovedadEnum::Transbordo->value,
                    'descripcion' => 'Cambio a otro vehículo',
                    'fecha' => Carbon::parse('2025-10-11 14:00:00'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        });
    }
}

