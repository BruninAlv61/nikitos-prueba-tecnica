<?php

namespace Database\Seeders;

use App\Models\NosotrosContenido;
use Illuminate\Database\Seeder;

class NosotrosContenidoSeeder extends Seeder
{
    public function run(): void
    {
        NosotrosContenido::registro();
    }
}
