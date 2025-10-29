<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Despacho
 */
class DespachoResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $novedades = NovedadResource::collection($this->whenLoaded('novedades'));
        $historial = HistorialEstadoDespachoResource::collection($this->whenLoaded('historialEstados'));

        return [
            'id' => $this->id,
            'conductor' => $this->conductor,
            'vehiculo' => $this->vehiculo,
            'estado' => $this->estado,
            'fecha' => $this->fecha?->toDateString(),
            'novedades' => $novedades,
            'mensaje_novedades' => $novedades->count() > 0
                ? null
                : 'No hay novedades registradas',
            'historial_estados' => $historial,
        ];
    }
}

