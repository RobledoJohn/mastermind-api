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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table -> enum('enum_medio_pago', ['Efectivo', 'PSE', 'Transferencia', 'Tarjeta de crédito', 'Tarjeta débito'])->default('Efectivo');

            //$table->foreignId('id_cliente')->constrained('clientes');
            //$table->foreignId('id_detalle_Venta')->constrained('detalle_ventas');
            //$table->foreignId('id_empresa')->constrained('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
