<?php

declare(strict_types=1);

namespace App\Repositorios;

use App\Models\Despacho;
use Illuminate\Database\Eloquent\Collection;

class DespachoRepositorio
{
    public function buscarPorId(int $idDespacho): ?Despacho
    {
        return Despacho::with('novedades')->find($idDespacho);
    }

    /**
     * @return Collection<int, Despacho>
     */
    public function listarTodos(): Collection
    {
        return Despacho::query()
            ->with('novedades')
            ->orderByDesc('fecha')
            ->get();
    }
}

