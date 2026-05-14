<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'codigo' => ['required', 'string', 'max:50', Rule::unique('productos', 'codigo')],
            'tamaño' => ['nullable', 'string', 'max:100'],
            'vida_util' => ['nullable', 'string', 'max:100'],
            'categoria_id' => ['required', 'integer', 'exists:categorias,id'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'destacado' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'codigo' => 'código',
            'tamaño' => 'tamaño',
            'vida_util' => 'vida útil',
            'categoria_id' => 'categoría',
            'imagen' => 'imagen',
            'destacado' => 'destacado',
        ];
    }
}
