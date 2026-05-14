<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Palitos Salados', 'codigo' => '336', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 1, 'imagen' => 'images/des1.png', 'destacado' => true],
            ['nombre' => 'Palitos de Queso', 'codigo' => '337', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 1, 'imagen' => 'images/des2.png', 'destacado' => true],
            ['nombre' => 'Papas Fritas Corte Clasico', 'codigo' => '338', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 3, 'imagen' => 'images/des3.png', 'destacado' => true],
            ['nombre' => 'Pizzitos de Jamón y Queso', 'codigo' => '339', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 4, 'imagen' => 'images/des4.png', 'destacado' => true],
        ];

        foreach ($productos as $prod) {
            Producto::create($prod);
        }
    }
}
