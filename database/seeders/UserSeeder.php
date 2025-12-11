<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donante;
use App\Models\Emprendedor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
        ]);

        // Emprendedor Principal
        $emprendedor = User::create([
            'name' => 'Juan Emprendedor',
            'email' => 'emprendedor@test.com',
            'password' => Hash::make('password'),
            'role' => 'Emprendedor',
        ]);
        Emprendedor::create([
            'user_id' => $emprendedor->id,
            'organizacion' => 'Startup Innovadora',
            'descripcion_personal' => 'Apasionado por la tecnología y el cambio social.',
        ]);

        // Donante Principal
        $donante = User::create([
            'name' => 'Maria Donante',
            'email' => 'donante@test.com',
            'password' => Hash::make('password'),
            'role' => 'Donante',
        ]);
        Donante::create([
            'user_id' => $donante->id,
            'direccion' => 'Calle Falsa 123',
            'telefono' => '555-1234',
        ]);

        // Random Users
        User::factory(10)->create()->each(function ($user) {
            $roles = ['Donante', 'Emprendedor'];
            $user->role = $roles[array_rand($roles)];
            $user->save();

            if ($user->role === 'Donante') {
                Donante::create(['user_id' => $user->id]);
            } else {
                Emprendedor::create(['user_id' => $user->id]);
            }
        });
    }
}