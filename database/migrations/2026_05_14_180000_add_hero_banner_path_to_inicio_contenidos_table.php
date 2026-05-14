<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inicio_contenidos', function (Blueprint $table) {
            $table->string('hero_banner_path')->nullable()->after('hero_catalogo_pdf');
        });
    }

    public function down(): void
    {
        Schema::table('inicio_contenidos', function (Blueprint $table) {
            $table->dropColumn('hero_banner_path');
        });
    }
};
