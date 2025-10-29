<?php

declare(strict_types=1);

namespace App\Repositorios;

use App\Enums\EstadoDespachoEnum;
use App\Models\HistorialEstadoDespacho;
use Illuminate\Support\Carbon;

class HistorialEstadoDespachoRepositorio
{
    public function registrarCambio(
        int $idDespacho,
        EstadoDespachoEnum $estadoAnterior,
        EstadoDespachoEnum $estadoNuevo,
        Carbon $cambiadoEn
    ): HistorialEstadoDespacho {
        $historial = new HistorialEstadoDespacho([
            'id_despacho' => $idDespacho,
            'estado_anterior' => $estadoAnterior->value,
            'estado_nuevo' => $estadoNuevo->value,
            'cambiado_en' => $cambiadoEn,
        ]);

        $historial->save();

        return $historial;
    }
}
