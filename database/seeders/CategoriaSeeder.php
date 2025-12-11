<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Tecnología', 'icono' => 'fas fa-laptop', 'color' => '#3b82f6'],
            ['nombre' => 'Medio Ambiente', 'icono' => 'fas fa-leaf', 'color' => '#10b981'],
            ['nombre' => 'Educación', 'icono' => 'fas fa-graduation-cap', 'color' => '#f59e0b'],
            ['nombre' => 'Salud', 'icono' => 'fas fa-heartbeat', 'color' => '#ef4444'],
            ['nombre' => 'Arte', 'icono' => 'fas fa-palette', 'color' => '#8b5cf6'],
            ['nombre' => 'Comunidad', 'icono' => 'fas fa-users', 'color' => '#6366f1'],
        ];

        foreach ($categorias as $cat) {
            Categoria::create([
                'nombre' => $cat['nombre'],
                'slug' => Str::slug($cat['nombre']),
                'descripcion' => 'Proyectos relacionados con ' . strtolower($cat['nombre']),
                'icono' => $cat['icono'],
                'color' => $cat['color'],
            ]);
        }
    }
}