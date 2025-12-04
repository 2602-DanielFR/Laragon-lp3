<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar seeders en orden
        $this->call([
            UserSeeder::class,
            // Aquí puedes agregar más seeders después
            // CategoriaSeeder::class,
            // ProyectoSeeder::class,
        ]);
    }
}
