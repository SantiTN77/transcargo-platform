<?php

declare(strict_types=1);

namespace App\Servicios;

use App\DTOs\ActualizarEstadoDespachoDTO;
use App\DTOs\RegistrarNovedadDTO;
use App\Enums\EstadoDespachoEnum;
use App\Enums\TipoNovedadEnum;
use App\Events\NovedadCriticaRegistrada;
use App\Models\Despacho;
use App\Models\NovedadDespacho;
use App\Repositorios\DespachoRepositorio;
use App\Repositorios\HistorialEstadoDespachoRepositorio;
use App\Repositorios\NovedadRepositorio;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Date;

class GestionDespachosServicio
{
    public function __construct(
        private readonly DespachoRepositorio $despachoRepositorio,
        private readonly NovedadRepositorio $novedadRepositorio,
        private readonly HistorialEstadoDespachoRepositorio $historialRepositorio
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

            Event::dispatch(new NovedadCriticaRegistrada($novedad->load('despacho')));
        }

        return $novedad;
    }

    /**
     * @throws ModelNotFoundException
     */
    public function actualizarEstadoDespacho(ActualizarEstadoDespachoDTO $datos): Despacho
    {
        $despacho = $this->obtenerDespachoOrFail($datos->idDespacho);

        if ($despacho->estado === $datos->estado->value) {
            return $despacho;
        }

        $estadoAnterior = EstadoDespachoEnum::from($despacho->estado);

        $this->despachoRepositorio->actualizarEstado($despacho, $datos->estado->value);

        $this->historialRepositorio->registrarCambio(
            idDespacho: $despacho->id,
            estadoAnterior: $estadoAnterior,
            estadoNuevo: $datos->estado,
            cambiadoEn: Date::now()
        );

        $despachoActualizado = $this->despachoRepositorio->buscarPorId($despacho->id);

        if ($despachoActualizado === null) {
            throw (new ModelNotFoundException())->setModel(Despacho::class, [$despacho->id]);
        }

        return $despachoActualizado;
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
