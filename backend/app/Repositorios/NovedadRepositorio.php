<?php

declare(strict_types=1);

namespace App\Repositorios;

use App\DTOs\RegistrarNovedadDTO;
use App\Models\NovedadDespacho;

class NovedadRepositorio
{
    public function crearDesdeDto(RegistrarNovedadDTO $datos): NovedadDespacho
    {
        $novedad = new NovedadDespacho([
            'id_despacho' => $datos->idDespacho,
            'tipo' => $datos->tipo,
            'descripcion' => $datos->descripcion,
            'fecha' => $datos->fecha,
        ]);

        $novedad->save();

        return $novedad->fresh();
    }
}

