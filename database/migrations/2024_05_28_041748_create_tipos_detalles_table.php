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
        Schema::create('tipos_detalles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->enum('enum_tipos_detalle', ['ingreso', 'Producto'])->default('Ingreso');

            //$table->foreignId('id_ingreso')->constrained('ingresos');
            //$table->foreignId('id_producto')->constrained('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_detalles');
    }
};
