<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class StoreContactoRequest extends FormRequest
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
        $tipo = $this->input('tipo');

        if ($tipo === 'ventas') {
            return [
                'tipo' => ['required', Rule::in(['ventas'])],
                'razon_social' => ['required', 'string', 'max:255'],
                'cuit' => ['required', 'string', 'max:20'],
                'tipo_negocio' => ['required', 'string', 'max:255'],
                'trayectoria' => ['nullable', 'string', 'max:255'],
                'direccion' => ['required', 'string', 'max:255'],
                'localidad' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:50'],
                'celular' => ['required', 'string', 'max:50'],
                'horario_atencion' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:255'],
                'observaciones' => ['required', 'string', 'max:10000'],
            ];
        }

        if ($tipo === 'rrhh') {
            return [
                'tipo' => ['required', Rule::in(['rrhh'])],
                'nombre' => ['required', 'string', 'max:255'],
                'sexo' => ['required', 'string', 'max:40'],
                'dni' => ['required', 'string', 'max:20'],
                'fecha_nacimiento' => ['required', 'date', 'before:today', 'after:1900-01-01'],
                'direccion' => ['required', 'string', 'max:255'],
                'localidad' => ['required', 'string', 'max:255'],
                'telefono' => ['required', 'string', 'max:50'],
                'email' => ['nullable', 'email', 'max:255'],
                'puesto_aspira' => ['required', Rule::in(['Ventas', 'Producción', 'Administración', 'Logística'])],
                'cv' => ['nullable', File::types(['pdf', 'doc', 'docx'])->max(2048)],
            ];
        }

        return [
            'tipo' => ['required', Rule::in(['ventas', 'rrhh'])],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'tipo' => 'tipo de consulta',
            'razon_social' => 'razón social',
            'cuit' => 'CUIT',
            'tipo_negocio' => 'tipo de negocio',
            'trayectoria' => 'trayectoria',
            'direccion' => 'dirección',
            'localidad' => 'localidad',
            'telefono' => 'teléfono',
            'celular' => 'celular',
            'horario_atencion' => 'horario de atención',
            'email' => 'correo electrónico',
            'observaciones' => 'observaciones',
            'nombre' => 'nombre',
            'sexo' => 'sexo',
            'dni' => 'DNI',
            'fecha_nacimiento' => 'fecha de nacimiento',
            'puesto_aspira' => 'puesto al que aspira',
            'cv' => 'curriculum vitae',
        ];
    }
}
