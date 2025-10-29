<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Enum TipoNovedadEnum
 *
 * Define el catálogo permitido de tipos de novedad para los despachos.
 */
enum TipoNovedadEnum: string
{
    case Retraso = 'Retraso';
    case Transbordo = 'Transbordo';
    case Dano = 'Daño';
    case Cancelacion = 'Cancelación';

    /**
     * @return list<string>
     */
    public static function valores(): array
    {
        return array_map(
            static fn (self $tipo): string => $tipo->value,
            self::cases()
        );
    }

    public function esCritica(): bool
    {
        return $this === self::Dano || $this === self::Cancelacion;
    }
}

