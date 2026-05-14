<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'color', 'imagen', 'catalogo'];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function getImagenUrlAttribute(): string
    {
        if (! $this->imagen) {
            return asset('images/placeholder.png');
        }

        if (str_starts_with($this->imagen, 'images/')) {
            return asset($this->imagen);
        }

        return asset('storage/'.$this->imagen);
    }
}
