<?php

declare(strict_types=1);

namespace App\Http\Requests\Despacho;

use App\DTOs\ActualizarEstadoDespachoDTO;
use App\Enums\EstadoDespachoEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActualizarEstadoDespachoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estado' => ['required', 'string', Rule::in(EstadoDespachoEnum::valores())],
        ];
    }

    public function generarDto(int $idDespacho): ActualizarEstadoDespachoDTO
    {
        return new ActualizarEstadoDespachoDTO(
            idDespacho: $idDespacho,
            estado: EstadoDespachoEnum::from($this->string('estado')->toString()),
        );
    }
}
