<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NosotrosContenido extends Model
{
    protected $table = 'nosotros_contenidos';

    protected $fillable = [
        'hero_titulo',
        'seccion_1_titulo',
        'seccion_1_cuerpo',
        'seccion_2_titulo',
        'seccion_2_cuerpo',
        'seccion_3_titulo',
        'seccion_3_cuerpo',
        'seccion_4_titulo',
        'seccion_4_cuerpo',
    ];

    /**
     * @return array<string, string>
     */
    public static function valoresPorDefecto(): array
    {
        return [
            'hero_titulo' => 'Nosotros',
            'seccion_1_titulo' => '¿Quienes somos?',
            'seccion_1_cuerpo' => <<<'TXT'
Somos una empresa familiar argentina dedicada a elaborar snacks de calidad, con foco en la inocuidad alimentaria y el sabor que acompaña el día a día de miles de hogares.

Nuestra planta combina procesos modernos con un equipo humano comprometido, para ofrecer productos confiables y deliciosos en cada presentación.

Trabajamos de la mano con proveedores y distribuidores para llegar a todo el país, manteniendo los estándares que nuestros consumidores esperan de Nikitos.
TXT,
            'seccion_2_titulo' => 'Nuestra planta modelo',
            'seccion_2_cuerpo' => <<<'TXT'
Contamos con instalaciones pensadas para la eficiencia y la higiene: líneas automatizadas, controles en proceso y ambientes diseñados para preservar la frescura del producto.

Cada etapa de producción se monitorea con rigurosidad, desde la materia prima hasta el empaque final, para asegurar consistencia y trazabilidad.
TXT,
            'seccion_3_titulo' => 'El equipo',
            'seccion_3_cuerpo' => 'Detrás de cada bolsa hay personas capacitadas en buenas prácticas de manufactura, capacitación continua y una cultura de trabajo colaborativo que impulsa la mejora constante.',
            'seccion_4_titulo' => 'Nuestra flota',
            'seccion_4_cuerpo' => 'La logística es parte esencial de nuestra promesa: una flota y operadores preparados para entregar pedidos con puntualidad y cuidado, cuidando la cadena de frío y la integridad del producto en ruta.',
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
