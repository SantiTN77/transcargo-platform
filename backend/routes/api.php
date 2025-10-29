<?php

use App\Http\Controllers\DespachoNovedadControlador;
use Illuminate\Support\Facades\Route;

Route::post('/novedades', [DespachoNovedadControlador::class, 'registrar']);
Route::get('/despachos/{idDespacho}', [DespachoNovedadControlador::class, 'mostrar'])
    ->whereNumber('idDespacho');

