<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donante;
use App\Models\Emprendedor;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ===== USUARIO ADMIN =====
        $admin = User::factory()
            ->admin()
            ->withName('Administrador Principal')
            ->withEmail('admin@crowdfunding.com')
            ->withPassword('Admin@2024')
            ->create();

        // ===== DONANTES (3 usuarios) =====
        $donante1 = User::factory()
            ->donante()
            ->withName('Juan García')
            ->withEmail('juan@example.com')
            ->withPassword('Donante@2024')
            ->create();

        Donante::factory()
            ->for($donante1, 'user')
            ->withDescripcion('Soy un donante apasionado por proyectos sociales y educativos.')
            ->withOrganizacion('Fundación García')
            ->withBiografia('Creo en el poder de la educación para cambiar vidas.')
            ->withEnlacesRedes([
                'facebook' => 'https://facebook.com/juangarcia',
                'twitter' => 'https://twitter.com/juangarcia',
                'linkedin' => 'https://linkedin.com/in/juangarcia',
                'instagram' => 'https://instagram.com/juangarcia',
            ])
            ->create();

        $donante2 = User::factory()
            ->donante()
            ->withName('Carlos Rodríguez')
            ->withEmail('carlos@example.com')
            ->withPassword('Donante@2024')
            ->create();

        Donante::factory()
            ->for($donante2, 'user')
            ->withDescripcion('Empresario interesado en invertir en iniciativas sostenibles.')
            ->withOrganizacion('Rodríguez & Co.')
            ->withBiografia('Impulso proyectos que generan impacto ambiental positivo.')
            ->withEnlacesRedes([
                'facebook' => 'https://facebook.com/carlosrodriguez',
                'twitter' => 'https://twitter.com/carlosrodriguez',
                'linkedin' => 'https://linkedin.com/in/carlosrodriguez',
                'instagram' => 'https://instagram.com/carlosrodriguez',
            ])
            ->create();

        $donante3 = User::factory()
            ->donante()
            ->withName('Sofía Pérez')
            ->withEmail('sofia@example.com')
            ->withPassword('Donante@2024')
            ->create();

        Donante::factory()
            ->for($donante3, 'user')
            ->withDescripcion('Profesional de tecnología comprometida con la inclusión digital.')
            ->withOrganizacion('Tech for Good')
            ->withBiografia('Apoyo proyectos de tecnología para comunidades vulnerables.')
            ->withEnlacesRedes([
                'facebook' => 'https://facebook.com/sofiaperez',
                'twitter' => 'https://twitter.com/sofiaperez',
                'linkedin' => 'https://linkedin.com/in/sofiaperez',
                'instagram' => 'https://instagram.com/sofiaperez',
            ])
            ->create();

        // ===== EMPRENDEDORES (3 usuarios) =====
        $emprendedor1 = User::factory()
            ->emprendedor()
            ->withName('María López')
            ->withEmail('maria@example.com')
            ->withPassword('Emprendedor@2024')
            ->create();

        Emprendedor::factory()
            ->for($emprendedor1, 'user')
            ->withDescripcion('Bióloga enfocada en conservación ambiental y educación ambiental.')
            ->withOrganizacion('Eco Verde')
            ->withBiografia('Promotora de iniciativas de reforestación y sostenibilidad.')
            ->withSitioWeb('https://marialopez.com')
            ->withEnlacesRedes([
                'facebook' => 'https://facebook.com/marialopez',
                'twitter' => 'https://twitter.com/marialopez',
                'linkedin' => 'https://linkedin.com/in/marialopez',
                'instagram' => 'https://instagram.com/marialopez',
                'sitio_web' => 'https://marialopez.com',
            ])
            ->create();

        $emprendedor2 = User::factory()
            ->emprendedor()
            ->withName('Ana Martínez')
            ->withEmail('ana@example.com')
            ->withPassword('Emprendedor@2024')
            ->create();

        Emprendedor::factory()
            ->for($emprendedor2, 'user')
            ->withDescripcion('Ingeniera de sistemas desarrolladora de soluciones tecnológicas para comunidades.')
            ->withOrganizacion('TechInnovate')
            ->withBiografia('Creo tecnología accesible para mejorar la calidad de vida.')
            ->withSitioWeb('https://anamartinez.dev')
            ->withEnlacesRedes([
                'facebook' => 'https://facebook.com/anamartinez',
                'twitter' => 'https://twitter.com/anamartinez',
                'linkedin' => 'https://linkedin.com/in/anamartinez',
                'instagram' => 'https://instagram.com/anamartinez',
                'sitio_web' => 'https://anamartinez.dev',
            ])
            ->create();

        $emprendedor3 = User::factory()
            ->emprendedor()
            ->withName('Pedro González')
            ->withEmail('pedro@example.com')
            ->withPassword('Emprendedor@2024')
            ->create();

        Emprendedor::factory()
            ->for($emprendedor3, 'user')
            ->withDescripcion('Médico comunitario con pasión por la salud preventiva y acceso universal.')
            ->withOrganizacion('Salud Para Todos')
            ->withBiografia('Impulso programas de salud para comunidades vulnerables.')
            ->withSitioWeb('https://pedrogonzalez.org')
            ->withEnlacesRedes([
                'facebook' => 'https://facebook.com/pedrogonzalez',
                'twitter' => 'https://twitter.com/pedrogonzalez',
                'linkedin' => 'https://linkedin.com/in/pedrogonzalez',
                'instagram' => 'https://instagram.com/pedrogonzalez',
                'sitio_web' => 'https://pedrogonzalez.org',
            ])
            ->create();

        // ===== MOSTRAR CREDENCIALES EN CONSOLA =====
        $this->command->info('');
        $this->command->info('╔════════════════════════════════════════════════════════════╗');
        $this->command->info('║  7 usuarios de prueba creados exitosamente!              ║');
        $this->command->info('╚════════════════════════════════════════════════════════════╝');
        $this->command->info('');

        $this->command->info('ADMINISTRADOR');
        $this->command->line('   Email:    admin@crowdfunding.com');
        $this->command->line('   Password: Admin@2024');
        $this->command->line('');

        $this->command->info('DONANTES (3)');
        $this->command->line('   1. juan@example.com        | Password: Donante@2024');
        $this->command->line('      Fundación García');
        $this->command->line('');
        $this->command->line('   2. carlos@example.com      | Password: Donante@2024');
        $this->command->line('      Rodríguez & Co.');
        $this->command->line('');
        $this->command->line('   3. sofia@example.com       | Password: Donante@2024');
        $this->command->line('      Tech for Good');
        $this->command->line('');

        $this->command->info('EMPRENDEDORES (3)');
        $this->command->line('   1. maria@example.com       | Password: Emprendedor@2024');
        $this->command->line('      Eco Verde');
        $this->command->line('');
        $this->command->line('   2. ana@example.com         | Password: Emprendedor@2024');
        $this->command->line('      TechInnovate');
        $this->command->line('');
        $this->command->line('   3. pedro@example.com       | Password: Emprendedor@2024');
        $this->command->line('      Salud Para Todos');
        $this->command->line('');

        $this->command->info('═══════════════════════════════════════════════════════════════');
        $this->command->info('Accede a: http://localhost:8000/login');
        $this->command->info('Panel Admin: http://localhost:8000/admin/dashboard');
        $this->command->info('═══════════════════════════════════════════════════════════════');
    }
}
