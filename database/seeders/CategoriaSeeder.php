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
            [
                'nombre' => 'Medio Ambiente',
                'slug' => 'medio-ambiente',
                'descripcion' => 'Proyectos enfocados en la conservación y protección del medio ambiente',
                'icono' => 'fas fa-leaf',
                'color' => '#10b981',
            ],
            [
                'nombre' => 'Educación',
                'slug' => 'educacion',
                'descripcion' => 'Iniciativas educativas y de capacitación',
                'icono' => 'fas fa-book',
                'color' => '#3b82f6',
            ],
            [
                'nombre' => 'Salud',
                'slug' => 'salud',
                'descripcion' => 'Proyectos relacionados con la salud y bienestar',
                'icono' => 'fas fa-heart',
                'color' => '#ef4444',
            ],
            [
                'nombre' => 'Tecnología',
                'slug' => 'tecnologia',
                'descripcion' => 'Innovación y desarrollo tecnológico',
                'icono' => 'fas fa-laptop',
                'color' => '#8b5cf6',
            ],
            [
                'nombre' => 'Comunidad',
                'slug' => 'comunidad',
                'descripcion' => 'Proyectos comunitarios y de desarrollo social',
                'icono' => 'fas fa-people-group',
                'color' => '#f59e0b',
            ],
            [
                'nombre' => 'Arte y Cultura',
                'slug' => 'arte-cultura',
                'descripcion' => 'Iniciativas artísticas y culturales',
                'icono' => 'fas fa-palette',
                'color' => '#ec4899',
            ],
            [
                'nombre' => 'Emprendimiento',
                'slug' => 'emprendimiento',
                'descripcion' => 'Proyectos empresariales y de emprendimiento',
                'icono' => 'fas fa-rocket',
                'color' => '#06b6d4',
            ],
            [
                'nombre' => 'Deporte',
                'slug' => 'deporte',
                'descripcion' => 'Proyectos relacionados con el deporte y actividad física',
                'icono' => 'fas fa-football',
                'color' => '#14b8a6',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['slug' => $categoria['slug']],
                $categoria
            );
        }
    }
}
