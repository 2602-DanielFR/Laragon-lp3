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
        Schema::create('donaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('monto', 12, 2);
            $table->string('estado')->default('completada'); // completada, pendiente, fallida, reembolsada
            $table->string('referencia')->nullable(); // Referencia de pago (transacción ID, etc.)
            $table->text('mensaje')->nullable(); // Mensaje opcional del donante
            $table->timestamps();

            // Índices para búsquedas comunes
            $table->index('proyecto_id');
            $table->index('user_id');
            $table->index('estado');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donaciones');
    }
};
