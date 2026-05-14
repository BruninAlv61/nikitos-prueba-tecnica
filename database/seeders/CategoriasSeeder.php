<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Línea tradicional escolar', 'color' => '#E63946', 'imagen' => 'images/cat1.png'],
            ['nombre' => 'Línea juvenil metalizada 1', 'color' => '#E63946', 'imagen' => 'images/cat2.png'],
            ['nombre' => 'Línea juvenil metalizada 2', 'color' => '#E63946', 'imagen' => 'images/cat3.png'],
            ['nombre' => 'Línea fraccionada cristal x 40grs', 'color' => '#9B5DE5', 'imagen' => 'images/cat4.png'],
            ['nombre' => 'Línea max', 'color' => '#9B5DE5', 'imagen' => 'images/cat1.png'],
            ['nombre' => 'Línea max x 65grs', 'color' => '#F4A261', 'imagen' => 'images/cat2.png'],
            ['nombre' => 'Línea fraccionada cristal x 80grs', 'color' => '#9B5DE5', 'imagen' => 'images/cat3.png'],
            ['nombre' => 'Línea premium max x 100grs', 'color' => '#F4A261', 'imagen' => 'images/cat4.png'],
            ['nombre' => 'Línea premium max x 120grs', 'color' => '#2EC4B6', 'imagen' => 'images/cat1.png'],
            ['nombre' => 'Línea familiar tradicional', 'color' => '#E63946', 'imagen' => 'images/cat2.png'],
            ['nombre' => 'Línea familiar cristal', 'color' => '#2EC4B6', 'imagen' => 'images/cat3.png'],
            ['nombre' => 'Línea combo', 'color' => '#2EC4B6', 'imagen' => 'images/cat4.png'],
            ['nombre' => 'Jugos', 'color' => '#E63946', 'imagen' => 'images/cat1.png'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}
