<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $conductor
 * @property string $vehiculo
 * @property string $estado
 * @property \Illuminate\Support\Carbon $fecha
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, NovedadDespacho> $novedades
 */
class Despacho extends Model
{
    use HasFactory;

    protected $table = 'despachos';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'conductor',
        'vehiculo',
        'estado',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function novedades(): HasMany
    {
        return $this->hasMany(NovedadDespacho::class, 'id_despacho');
    }
}

