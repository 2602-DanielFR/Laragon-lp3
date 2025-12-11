<?php

namespace Database\Factories;

use App\Models\Donante;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donante>
 */
class DonanteFactory extends Factory
{
    protected $model = Donante::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->donante(),
            'descripcion_personal' => fake()->paragraph(),
            'organizacion' => fake()->company(),
            'foto_perfil' => fake()->imageUrl(300, 300, 'people'),
            'biografia_breve' => fake()->text(150),
            'enlaces_redes' => [
                'facebook' => fake()->url(),
                'twitter' => fake()->url(),
                'linkedin' => fake()->url(),
                'instagram' => fake()->url(),
            ],
        ];
    }

    /**
     * Crear un donante con descripción personalizada
     */
    public function withDescripcion(string $descripcion): static
    {
        return $this->state(fn (array $attributes) => [
            'descripcion_personal' => $descripcion,
        ]);
    }

    /**
     * Crear un donante con organización personalizada
     */
    public function withOrganizacion(string $organizacion): static
    {
        return $this->state(fn (array $attributes) => [
            'organizacion' => $organizacion,
        ]);
    }

    /**
     * Crear un donante con biografía personalizada
     */
    public function withBiografia(string $biografia): static
    {
        return $this->state(fn (array $attributes) => [
            'biografia_breve' => $biografia,
        ]);
    }

    /**
     * Crear un donante con enlaces de redes sociales
     */
    public function withEnlacesRedes(array $enlaces): static
    {
        return $this->state(fn (array $attributes) => [
            'enlaces_redes' => $enlaces,
        ]);
    }

    /**
     * Crear un donante sin foto de perfil
     */
    public function sinFoto(): static
    {
        return $this->state(fn (array $attributes) => [
            'foto_perfil' => null,
        ]);
    }
}
