<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $categorias = [
        ['nombre' => 'Línea tradicional escolar', 'color' => '#E63946'],
        ['nombre' => 'Línea juvenil metalizada 1', 'color' => '#E63946'],
        ['nombre' => 'Línea juvenil metalizada 2', 'color' => '#E63946'],
        ['nombre' => 'Línea fraccionada cristal x 40grs', 'color' => '#9B5DE5'],
        ['nombre' => 'Línea max', 'color' => '#9B5DE5'],
        ['nombre' => 'Línea max x 65grs', 'color' => '#F4A261'],
        ['nombre' => 'Línea fraccionada cristal x 80grs', 'color' => '#9B5DE5'],
        ['nombre' => 'Línea premium max x 100grs', 'color' => '#F4A261'],
        ['nombre' => 'Línea premium max x 120grs', 'color' => '#2EC4B6'],
        ['nombre' => 'Línea familiar tradicional', 'color' => '#E63946'],
        ['nombre' => 'Línea familiar cristal', 'color' => '#2EC4B6'],
        ['nombre' => 'Línea combo', 'color' => '#2EC4B6'],
        ['nombre' => 'Jugos', 'color' => '#E63946'],
    ];

    foreach ($categorias as $cat) {
        \App\Models\Categoria::create($cat);
    }
}
}
