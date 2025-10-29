<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $id_despacho
 * @property string $estado_anterior
 * @property string $estado_nuevo
 * @property \Illuminate\Support\Carbon $cambiado_en
 */
class HistorialEstadoDespacho extends Model
{
    public const UPDATED_AT = null;

    protected $table = 'historial_estados_despacho';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_despacho',
        'estado_anterior',
        'estado_nuevo',
        'cambiado_en',
    ];

    protected $casts = [
        'cambiado_en' => 'datetime',
    ];

    public function despacho(): BelongsTo
    {
        return $this->belongsTo(Despacho::class, 'id_despacho');
    }
}
