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
            $table->timestamps();

            $table->enum('enum_estado_reparacion', ['Sin asignar', 'Recepción', 'Diagnóstico', 'Reparación', 
            'Esperando Repuesto', 'Pruebas', 'Listo para entrega', 'Finalizado'])->default('Sin asignar');

            //$table->foreignId('id_tecnico')->constrained('tecnicos');
            //$table->foreignId('id_equipo')->constrained('equipos');
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
