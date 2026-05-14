<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreRecetaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('porciones')) {
            $this->merge(['porciones' => 1]);
        }
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'tiempo_preparacion' => ['nullable', 'string', 'max:100'],
            'porciones' => ['nullable', 'integer', 'min:1', 'max:500'],
            'imagen' => ['nullable', 'image', 'max:4096'],
            'ingredientes' => ['nullable', 'array', 'max:100'],
            'ingredientes.*' => ['nullable', 'string', 'max:500'],
            'pasos' => ['nullable', 'array', 'max:80'],
            'pasos.*' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $ingredientes = array_filter(
                $this->input('ingredientes', []),
                static fn ($v): bool => is_string($v) && trim($v) !== ''
            );
            if (count($ingredientes) < 1) {
                $validator->errors()->add('ingredientes', 'Tenés que cargar al menos un ingrediente.');
            }

            $pasos = array_filter(
                $this->input('pasos', []),
                static fn ($v): bool => is_string($v) && trim($v) !== ''
            );
            if (count($pasos) < 1) {
                $validator->errors()->add('pasos', 'Tenés que cargar al menos un paso de preparación.');
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'tiempo_preparacion' => 'tiempo de preparación',
            'porciones' => 'porciones',
            'imagen' => 'imagen',
            'ingredientes' => 'ingredientes',
            'pasos' => 'pasos',
        ];
    }
}
