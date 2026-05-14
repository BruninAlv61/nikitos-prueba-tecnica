<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'codigo', 'tamaño', 'vida_util', 'imagen', 'categoria_id', 'destacado'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

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
