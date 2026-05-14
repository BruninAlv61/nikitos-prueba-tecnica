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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['ventas', 'rrhh']);
            // Ventas
            $table->string('razon_social')->nullable();
            $table->string('cuit')->nullable();
            $table->string('tipo_negocio')->nullable();
            $table->string('trayectoria')->nullable();
            $table->string('direccion')->nullable();
            $table->string('localidad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('horario_atencion')->nullable();
            $table->string('email')->nullable();
            $table->text('observaciones')->nullable();
            // RRHH
            $table->string('nombre')->nullable();
            $table->string('sexo')->nullable();
            $table->string('dni')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('puesto_aspira')->nullable();
            $table->string('cv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};
