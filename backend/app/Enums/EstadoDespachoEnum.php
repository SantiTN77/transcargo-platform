<?php

declare(strict_types=1);

namespace App\Enums;

enum EstadoDespachoEnum: string
{
    case EnRuta = 'En ruta';
    case Entregado = 'Entregado';
    case Retrasado = 'Retrasado';
    case Cancelado = 'Cancelado';

    /**
     * @return list<string>
     */
    public static function valores(): array
    {
        return array_map(
            static fn (self $estado): string => $estado->value,
            self::cases()
        );
    }
}
