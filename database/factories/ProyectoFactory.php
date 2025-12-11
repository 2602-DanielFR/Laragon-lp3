<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proyecto;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $objetivo = $this->faker->numberBetween(1000, 50000);
        $montoActual = $this->faker->numberBetween(0, $objetivo);
        
        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraphs(3, true),
            'descripcion_corta' => $this->faker->paragraph(),
            'objetivo_recaudacion' => $objetivo,
            'monto_actual' => $montoActual,
            'estado' => $this->faker->randomElement([
                Proyecto::STATUS_DRAFT,
                Proyecto::STATUS_PENDING,
                Proyecto::STATUS_ACTIVE,
                Proyecto::STATUS_COMPLETED,
                Proyecto::STATUS_REJECTED
            ]),
            'fecha_inicio' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'fecha_fin' => $this->faker->dateTimeBetween('now', '+2 months'),
            'contador_donantes' => $this->faker->numberBetween(0, 100),
            'contador_donaciones' => $this->faker->numberBetween(0, 150),
            'porcentaje_alcanzado' => ($montoActual / $objetivo) * 100,
            // 'user_id' and 'categoria_id' se asignan en el seeder
        ];
    }
}