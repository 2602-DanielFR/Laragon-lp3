<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emprendedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->unique()->onDelete('cascade');
            // DB columns use snake_case; model will expose attributes as-is
            $table->text('descripcion_personal')->nullable();
            $table->string('organizacion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emprendedores');
    }
};
