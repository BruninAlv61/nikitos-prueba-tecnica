<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNosotrosContenidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'hero_titulo' => ['required', 'string', 'max:120'],
            'seccion_1_titulo' => ['required', 'string', 'max:255'],
            'seccion_1_cuerpo' => ['required', 'string', 'max:20000'],
            'seccion_2_titulo' => ['required', 'string', 'max:255'],
            'seccion_2_cuerpo' => ['required', 'string', 'max:20000'],
            'seccion_3_titulo' => ['required', 'string', 'max:255'],
            'seccion_3_cuerpo' => ['required', 'string', 'max:20000'],
            'seccion_4_titulo' => ['required', 'string', 'max:255'],
            'seccion_4_cuerpo' => ['required', 'string', 'max:20000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'hero_titulo' => 'título del banner',
            'seccion_1_titulo' => 'título sección 1',
            'seccion_1_cuerpo' => 'texto sección 1',
            'seccion_2_titulo' => 'título sección 2',
            'seccion_2_cuerpo' => 'texto sección 2',
            'seccion_3_titulo' => 'título sección 3',
            'seccion_3_cuerpo' => 'texto sección 3',
            'seccion_4_titulo' => 'título sección 4',
            'seccion_4_cuerpo' => 'texto sección 4',
        ];
    }
}
