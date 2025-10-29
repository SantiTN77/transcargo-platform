<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TipoNovedadEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $id_despacho
 * @property string $tipo
 * @property string $descripcion
 * @property \Illuminate\Support\Carbon $fecha
 *
 * @property-read Despacho $despacho
 */
class NovedadDespacho extends Model
{
    use HasFactory;

    protected $table = 'novedades';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'id_despacho',
        'tipo',
        'descripcion',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'tipo' => TipoNovedadEnum::class,
    ];

    public function despacho(): BelongsTo
    {
        return $this->belongsTo(Despacho::class, 'id_despacho');
    }
}

