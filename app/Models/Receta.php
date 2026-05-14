<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo',
        'imagen',
        'tiempo_preparacion',
        'porciones',
        'ingredientes',
        'pasos',
    ];

    protected $casts = [
        'ingredientes' => 'array',
        'pasos' => 'array',
        'porciones' => 'integer',
    ];

    public function getImagenUrlAttribute(): string
    {
        if (! $this->imagen) {
            return asset('images/placeholder.png');
        }

        // Si empieza con 'images/' es del seeder (public/)
        if (str_starts_with($this->imagen, 'images/')) {
            return asset($this->imagen);
        }

        // Si no, es una imagen subida desde el admin (storage/)
        return asset('storage/'.$this->imagen);
    }
}
