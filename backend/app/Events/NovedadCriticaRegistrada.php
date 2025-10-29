<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\NovedadDespacho;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovedadCriticaRegistrada
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public readonly NovedadDespacho $novedad)
    {
    }
}
