<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Despacho\ActualizarEstadoDespachoRequest;
use App\Http\Requests\Despacho\RegistrarNovedadRequest;
use App\Http\Resources\DespachoResource;
use App\Http\Resources\NovedadResource;
use App\Servicios\GestionDespachosServicio;
use Illuminate\Http\JsonResponse;

class DespachoNovedadControlador extends Controller
{
    public function __construct(
        private readonly GestionDespachosServicio $gestionDespachosServicio
    ) {
    }

    public function registrar(RegistrarNovedadRequest $solicitud): JsonResponse
    {
        $novedad = $this->gestionDespachosServicio->registrarNovedad(
            $solicitud->generarDto()
        );

        return response()->json(new NovedadResource($novedad), JsonResponse::HTTP_CREATED);
    }

    public function mostrar(int $idDespacho): JsonResponse
    {
        $despacho = $this->gestionDespachosServicio->consultarDespacho($idDespacho);

        return response()->json(new DespachoResource($despacho));
    }

    public function actualizarEstado(int $idDespacho, ActualizarEstadoDespachoRequest $solicitud): JsonResponse
    {
        $despacho = $this->gestionDespachosServicio->actualizarEstadoDespacho(
            $solicitud->generarDto($idDespacho)
        );

        return response()->json(new DespachoResource($despacho));
    }
}

