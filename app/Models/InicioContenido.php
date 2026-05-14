<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InicioContenido extends Model
{
    protected $table = 'inicio_contenidos';

    protected $fillable = [
        'hero_titulo',
        'hero_texto',
        'hero_catalogo_pdf',
        'hero_banner_path',
        'about_us_texto',
    ];

    /**
     * @return array<string, string>
     */
    public static function valoresPorDefecto(): array
    {
        return [
            'hero_titulo' => 'Nikitos Snacks',
            'hero_texto' => 'Nikitos se encuentra presente en el mercado local desde hace 40 años.',
            'hero_catalogo_pdf' => null,
            'hero_banner_path' => null,
            'about_us_texto' => 'Nikitos se encuentra presente en el mercado local desde hace 40 años. Ofreciendo un variado portfolio de snacks , tales como Pizzitos, Palitos salados, Maikitos de Queso, Papas Fritas, Cereales, Pochoclos Acaramelados, Bolitas/Aritos dulces, y Jugos para Congelar. El objetivo es llegar a los consumidores con ingredientes de calidad, contando con presencia de venta en todo el país y atención de excelencia.',
        ];
    }

    public static function registro(): self
    {
        $existente = static::query()->first();

        if ($existente !== null) {
            return $existente;
        }

        return static::query()->create(static::valoresPorDefecto());
    }
}
