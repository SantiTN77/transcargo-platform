<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\EstadoDespachoEnum;

final readonly class ActualizarEstadoDespachoDTO
{
    public function __construct(
        public int $idDespacho,
        public EstadoDespachoEnum $estado
    ) {
    }
}
