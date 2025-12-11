<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donacion>
 */
class DonacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'monto' => $this->faker->numberBetween(10, 500),
            'estado' => 'completada',
            'referencia' => 'SIM-' . $this->faker->uuid(),
            'mensaje' => $this->faker->sentence(),
            // 'user_id' and 'proyecto_id' se asignan en el seeder
        ];
    }
}