<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('restrict');
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('descripcion_corta')->nullable();
            $table->decimal('objetivo_recaudacion', 12, 2);
            $table->decimal('monto_actual', 12, 2)->default(0);
            $table->string('estado')->default('draft'); // draft, pendiente_revision, activo, completado, cancelado, rechazado
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->string('imagen')->nullable();
            $table->string('imagen_banner')->nullable();
            $table->integer('contador_donantes')->default(0);
            $table->integer('contador_donaciones')->default(0);
            $table->decimal('porcentaje_alcanzado', 5, 2)->default(0);
            $table->text('razon_rechazo')->nullable();
            $table->timestamps();

            // Índices para búsquedas comunes
            $table->index('estado');
            $table->index('categoria_id');
            $table->index('user_id');
            $table->index('fecha_inicio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
