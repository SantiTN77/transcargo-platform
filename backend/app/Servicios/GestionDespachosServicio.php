<?php

declare(strict_types=1);

namespace App\Servicios;

use App\DTOs\RegistrarNovedadDTO;
use App\Enums\TipoNovedadEnum;
use App\Models\Despacho;
use App\Models\NovedadDespacho;
use App\Repositorios\DespachoRepositorio;
use App\Repositorios\NovedadRepositorio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class GestionDespachosServicio
{
    public function __construct(
        private readonly DespachoRepositorio $despachoRepositorio,
        private readonly NovedadRepositorio $novedadRepositorio
    ) {
    }

    /**
     * @throws ModelNotFoundException
     */
    public function registrarNovedad(RegistrarNovedadDTO $datos): NovedadDespacho
    {
        $despacho = $this->obtenerDespachoOrFail($datos->idDespacho);

        $novedad = $this->novedadRepositorio->crearDesdeDto($datos);

        if ($datos->tipo->esCritica()) {
            // Canal Slack configurado para avisos operativos críticos.
            Log::channel('slack')->warning(
                sprintf(
                    'Novedad crítica registrada en despacho %d (%s): %s',
                    $despacho->id,
                    $datos->tipo->value,
                    $datos->descripcion
                )
            );
        }

        return $novedad;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function consultarDespacho(int $idDespacho): Despacho
    {
        return $this->obtenerDespachoOrFail($idDespacho);
    }

    /**
     * @throws ModelNotFoundException
     */
    private function obtenerDespachoOrFail(int $idDespacho): Despacho
    {
        $despacho = $this->despachoRepositorio->buscarPorId($idDespacho);

        if ($despacho === null) {
            throw (new ModelNotFoundException())->setModel(Despacho::class, [$idDespacho]);
        }

        return $despacho;
    }
}
