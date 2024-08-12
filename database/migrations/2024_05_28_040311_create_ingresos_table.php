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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('enlace_seguimiento');
            $table->string('descripcion');
            $table->timestamps();

            $table->enum('enum_estado_reparacion', ['Recepción', 'Diagnóstico', 'Reparación', 
            'Esperando Repuesto', 'Pruebas', 'Listo para entrega', 'Finalizado'])->default('Recepción');

            $table->foreignId('id_tecnico')->constrained('tecnicos')->onDelete('cascade');
            $table->foreignId('id_equipo')->constrained('equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
