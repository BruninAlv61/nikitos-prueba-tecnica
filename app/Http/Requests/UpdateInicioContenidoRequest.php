<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateInicioContenidoRequest extends FormRequest
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
            'hero_titulo' => ['required', 'string', 'max:255'],
            'hero_texto' => ['required', 'string', 'max:5000'],
            'hero_catalogo_pdf' => ['nullable', File::types(['pdf'])->max(20480)],
            'about_us_texto' => ['required', 'string', 'max:10000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'hero_titulo' => 'título del hero',
            'hero_texto' => 'texto del hero',
            'hero_catalogo_pdf' => 'catálogo PDF',
            'about_us_texto' => 'texto Nosotros',
        ];
    }
}
