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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->unique();
            $table->integer('monto')->unique();
            $table->string('descripcion');
            $table->timestamps();

            $table->enum('enum_tipo_detalle', ['Ingreso', 'Producto'])->default('Ingreso');

            $table->foreignId('id_producto')->constrained('productos')->onDelete('cascade');
            $table->foreignId('id_ingreso')->constrained('ingresos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};