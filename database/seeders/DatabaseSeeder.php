<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
                User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'test@example.com',
                ]);
        */
        // Crear usuario administrador demo
        User::updateOrCreate(
            ['email' => 'admin@nikitos.com.ar'],
            [
                'name' => 'Admin Nikitos',
                'password' => bcrypt('admin123'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            CategoriasSeeder::class,
            ProductosSeeder::class,
            NosotrosContenidoSeeder::class,
            RecetaSeeder::class,
        ]);

    }
}
