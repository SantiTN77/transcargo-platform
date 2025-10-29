<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\NovedadDespacho
 */
class NovedadResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo->value,
            'descripcion' => $this->descripcion,
            'fecha' => $this->fecha?->toIso8601String(),
        ];
    }
}

