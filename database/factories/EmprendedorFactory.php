<?php

namespace Database\Factories;

use App\Models\Emprendedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Emprendedor>
 */
class EmprendedorFactory extends Factory
{
    protected $model = Emprendedor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->emprendedor(),
            'descripcion_personal' => fake()->paragraph(),
            'organizacion' => fake()->company(),
            'foto_perfil' => fake()->imageUrl(300, 300, 'people'),
            'biografia_breve' => fake()->text(150),
            'enlaces_redes' => [
                'facebook' => fake()->url(),
                'twitter' => fake()->url(),
                'linkedin' => fake()->url(),
                'instagram' => fake()->url(),
                'sitio_web' => fake()->url(),
            ],
        ];
    }

    /**
     * Crear un emprendedor con descripción personalizada
     */
    public function withDescripcion(string $descripcion): static
    {
        return $this->state(fn (array $attributes) => [
            'descripcion_personal' => $descripcion,
        ]);
    }

    /**
     * Crear un emprendedor con organización personalizada
     */
    public function withOrganizacion(string $organizacion): static
    {
        return $this->state(fn (array $attributes) => [
            'organizacion' => $organizacion,
        ]);
    }

    /**
     * Crear un emprendedor con biografía personalizada
     */
    public function withBiografia(string $biografia): static
    {
        return $this->state(fn (array $attributes) => [
            'biografia_breve' => $biografia,
        ]);
    }

    /**
     * Crear un emprendedor con enlaces de redes sociales
     */
    public function withEnlacesRedes(array $enlaces): static
    {
        return $this->state(fn (array $attributes) => [
            'enlaces_redes' => $enlaces,
        ]);
    }

    /**
     * Crear un emprendedor sin foto de perfil
     */
    public function sinFoto(): static
    {
        return $this->state(fn (array $attributes) => [
            'foto_perfil' => null,
        ]);
    }

    /**
     * Crear un emprendedor con sitio web
     */
    public function withSitioWeb(string $sitioWeb): static
    {
        return $this->state(fn (array $attributes) => [
            'enlaces_redes' => array_merge(
                $attributes['enlaces_redes'] ?? [],
                ['sitio_web' => $sitioWeb]
            ),
        ]);
    }
}
