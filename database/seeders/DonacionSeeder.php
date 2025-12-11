<?php

namespace Database\Seeders;

use App\Models\Donacion;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Database\Seeder;

class DonacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyectos = Proyecto::where('estado', Proyecto::STATUS_ACTIVE)->get();
        $donantes = User::where('role', 'Donante')->get();

        if ($proyectos->isEmpty() || $donantes->isEmpty()) {
            return;
        }

        foreach ($proyectos as $proyecto) {
            $numDonations = rand(1, 5);
            for ($i = 0; $i < $numDonations; $i++) {
                $donante = $donantes->random();
                $monto = rand(10, 500);

                Donacion::create([
                    'proyecto_id' => $proyecto->id,
                    'user_id' => $donante->id,
                    'monto' => $monto,
                    'estado' => 'completada',
                    'referencia' => 'SEED-' . uniqid(),
                    'mensaje' => '¡Gran proyecto! Mucha suerte.',
                ]);
                $proyecto->increment('monto_actual', $monto);
                $proyecto->increment('contador_donaciones');
                $proyecto->increment('contador_donantes');
            }
            
            if ($proyecto->objetivo_recaudacion > 0) {
                $pct = ($proyecto->monto_actual / $proyecto->objetivo_recaudacion) * 100;
                $proyecto->update(['porcentaje_alcanzado' => $pct]);
            }
        }
    }
}