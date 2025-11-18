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
        Schema::table('donantes', function (Blueprint $table) {
            $table->string('foto_perfil')->nullable()->after('telefono');
            $table->text('biografia_breve')->nullable()->after('foto_perfil');
            $table->json('enlaces_redes')->nullable()->after('biografia_breve');
        });

        Schema::table('emprendedores', function (Blueprint $table) {
            $table->string('foto_perfil')->nullable()->after('organizacion');
            $table->text('biografia_breve')->nullable()->after('foto_perfil');
            $table->json('enlaces_redes')->nullable()->after('biografia_breve');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donantes', function (Blueprint $table) {
            $table->dropColumn(['foto_perfil', 'biografia_breve', 'enlaces_redes']);
        });

        Schema::table('emprendedores', function (Blueprint $table) {
            $table->dropColumn(['foto_perfil', 'biografia_breve', 'enlaces_redes']);
        });
    }
};
