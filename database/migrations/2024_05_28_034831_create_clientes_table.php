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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20);
            $table->integer('identificacion')->unique();
            $table->string('email')->unique();
            $table->string('clave');
            $table->integer('telefono');
            $table->string('avatar')->default('default-avatar.png');
            $table->string('direccion', 100);
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->enum('tipo_documento', ['CC', 'CE', 'Pasaporte'])->default('CC');

            //$table->foreignId('id_empresa')->constrained('empresas');
            //$table->foreignId('id_ciudad')->constrained('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
