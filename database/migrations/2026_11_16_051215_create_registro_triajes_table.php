<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registro_triajes', function (Blueprint $table) {
            $table->id();
            $table->string('paciente_dni', 8);
            $table->decimal('temperatura', 4, 1);
            $table->integer('frecuencia_cardiaca');
            $table->string('mensaje_alerta');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registro_triajes');
    }
};
