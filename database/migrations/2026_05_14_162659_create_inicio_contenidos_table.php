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
        Schema::create('inicio_contenidos', function (Blueprint $table) {
            $table->id();
            $table->string('hero_titulo')->default('Nikitos Snacks');
            $table->text('hero_texto');
            $table->string('hero_catalogo_pdf')->nullable();
            $table->text('about_us_texto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inicio_contenidos');
    }
};
