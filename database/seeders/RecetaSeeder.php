<?php

namespace Database\Seeders;

use App\Models\Receta;
use Illuminate\Database\Seeder;

class RecetaSeeder extends Seeder
{
    public function run(): void
    {
        $recetas = [
            [
                'titulo' => 'Nachos de tacos en sartén',
                'imagen' => 'images/recetas/nachos-tacos.jpg',
                'tiempo_preparacion' => '5 minutos',
                'porciones' => 8,
                'ingredientes' => [
                    '1 bolsa de papas fritas Nikitos clásicas',
                    '1 cucharada de aceite vegetal o de canola',
                    '450 g de carne de res molida',
                    'Aderezo para carne (30 g)',
                    '2/3 taza de agua',
                    '340 g de queso cheddar rallado',
                    'Chiles jalapeños conservados',
                    'Cebollas conservadas',
                    'Salsa criolla',
                    'Guacamole',
                    'Crema',
                ],
                'pasos' => [
                    'Precalienta el horno a 190 °C.',
                    'Calienta el aceite en una sartén mediana a fuego medio-alto. Dora la carne molida hasta que esté completamente cocida. Agrega el aderezo para res y el agua y cocina hasta que el agua se evapore y se espese hasta formar una salsa.',
                    'En una sartén grande de hierro fundido (u otra fuente para hornear) coloca las papas fritas, carne de ternera para tacos, la mitad del queso cheddar, las cebollas conservadas, los jalapeños conservados y la otra mitad de queso cheddar.',
                    'Hornea durante 5 a 7 minutos, hasta que el queso burbujee y se derrita por completo.',
                    'Sirve con crema, salsa criolla y guacamole.',
                ],
            ],
            [
                'titulo' => 'Papas con huevo revuelto',
                'imagen' => null,
                'tiempo_preparacion' => '10 minutos',
                'porciones' => 2,
                'ingredientes' => [
                    '1 bolsa de papas fritas Nikitos sabor original',
                    '3 huevos',
                    '2 cucharadas de manteca',
                    'Sal y pimienta a gusto',
                    'Cebolla de verdeo picada',
                ],
                'pasos' => [
                    'Batí los huevos en un bol con sal y pimienta.',
                    'Derretí la manteca en una sartén a fuego medio.',
                    'Volcá los huevos y revolvé suavemente hasta que estén apenas cuajados.',
                    'Apagá el fuego y agregá las papas fritas para que conserven el crunch.',
                    'Servís de inmediato con cebolla de verdeo picada por encima.',
                ],
            ],
            [
                'titulo' => 'Pollo crocante con papas al horno',
                'imagen' => null,
                'tiempo_preparacion' => '45 minutos',
                'porciones' => 4,
                'ingredientes' => [
                    '4 muslos de pollo con piel',
                    '1 bolsa de papas fritas Nikitos sabor limón',
                    '2 cucharadas de aceite de oliva',
                    'Sal, pimienta, ajo en polvo y páprika',
                    'Jugo de 1 limón',
                ],
                'pasos' => [
                    'Precalentá el horno a 200 °C.',
                    'Condimentá el pollo con sal, pimienta, ajo en polvo y páprika. Rociá con aceite de oliva y jugo de limón.',
                    'Colocá el pollo en una fuente y horneá 35 minutos.',
                    'Triturá groseramente las papas fritas y cubrir el pollo en los últimos 10 minutos de cocción para formar una costra crocante.',
                    'Servís caliente con ensalada fresca.',
                ],
            ],
        ];

        foreach ($recetas as $data) {
            Receta::firstOrCreate(
                ['titulo' => $data['titulo']],
                $data
            );
        }
    }
}
