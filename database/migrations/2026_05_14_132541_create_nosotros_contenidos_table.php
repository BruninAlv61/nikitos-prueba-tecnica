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
        Schema::create('nosotros_contenidos', function (Blueprint $table) {
            $table->id();
            $table->string('hero_titulo')->default('Nosotros');
            $table->string('seccion_1_titulo');
            $table->longText('seccion_1_cuerpo');
            $table->string('seccion_2_titulo');
            $table->longText('seccion_2_cuerpo');
            $table->string('seccion_3_titulo');
            $table->longText('seccion_3_cuerpo');
            $table->string('seccion_4_titulo');
            $table->longText('seccion_4_cuerpo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nosotros_contenidos');
    }
};
