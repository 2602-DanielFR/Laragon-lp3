<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use App\Models\User;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emprendedores = User::where('role', 'Emprendedor')->get();
        $categorias = Categoria::all();

        if ($emprendedores->isEmpty() || $categorias->isEmpty()) {
            return;
        }

        foreach ($emprendedores as $emprendedor) {
            Proyecto::factory(3)->create([
                'user_id' => $emprendedor->id,
                'categoria_id' => $categorias->random()->id,
            ]);
        }
    }
}