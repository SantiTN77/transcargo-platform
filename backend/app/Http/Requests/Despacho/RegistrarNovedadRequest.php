<?php

declare(strict_types=1);

namespace App\Http\Requests\Despacho;

use App\DTOs\RegistrarNovedadDTO;
use App\Enums\TipoNovedadEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class RegistrarNovedadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'id_despacho' => ['required', 'integer', 'min:1'],
            'tipo' => ['required', 'string', Rule::in(TipoNovedadEnum::valores())],
            'descripcion' => ['required', 'string', 'max:500'],
            'fecha' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_despacho.required' => 'El campo id_despacho es obligatorio.',
            'tipo.in' => 'El tipo de novedad no es válido.',
        ];
    }

    public function generarDto(): RegistrarNovedadDTO
    {
        /** @var array{id_despacho:int,tipo:string,descripcion:string,fecha:string} $datos */
        $datos = $this->validated();

        return new RegistrarNovedadDTO(
            idDespacho: $datos['id_despacho'],
            tipo: TipoNovedadEnum::from($datos['tipo']),
            descripcion: $datos['descripcion'],
            fecha: Carbon::parse($datos['fecha'])
        );
    }
}
