<?php

declare(strict_types=1);

namespace App\DTOs;

use App\Enums\TipoNovedadEnum;
use Illuminate\Support\Carbon;

final readonly class RegistrarNovedadDTO
{
    public function __construct(
        public int $idDespacho,
        public TipoNovedadEnum $tipo,
        public string $descripcion,
        public Carbon $fecha
    ) {
    }
}

