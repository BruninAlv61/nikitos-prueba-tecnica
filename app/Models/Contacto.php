<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'tipo',
        'razon_social', 'cuit', 'tipo_negocio', 'trayectoria',
        'direccion', 'localidad', 'telefono', 'celular',
        'horario_atencion', 'email', 'observaciones',
        'nombre', 'sexo', 'dni', 'fecha_nacimiento',
        'puesto_aspira', 'cv',
    ];
}
