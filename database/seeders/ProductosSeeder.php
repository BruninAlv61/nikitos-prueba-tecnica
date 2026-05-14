<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $productos = [
        ['nombre' => 'Palitos Salados', 'codigo' => '336', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 1],
        ['nombre' => 'Palitos de Queso', 'codigo' => '337', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 1],
        ['nombre' => 'Papas Fritas Corte Clasico', 'codigo' => '338', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 3],
        ['nombre' => 'Pizzitos de Jamón y Queso', 'codigo' => '339', 'tamaño' => '8px20ux20grs', 'vida_util' => '8 meses', 'categoria_id' => 4],
    ];

    foreach ($productos as $prod) {
        \App\Models\Producto::create($prod);
    }
}
}
