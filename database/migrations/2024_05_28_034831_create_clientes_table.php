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
            $table->bigInteger('identificacion')->unique();
            $table->string('email')->unique();
            $table->string('clave');
            $table->bigInteger('telefono')->unique();
            $table->string('avatar')->default('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNL_ZnOTpXSvhf1UaK7beHey2BX42U6solRA&s');
            $table->string('direccion', 100);
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->enum('enum_tipo_documento', [
                'Cedula de Ciudadania', 
                'Tarjeta de Identidad', 
                'Cedula de Extranjeria', 
                'Pasaporte', 
                'Registro Civil',
                'NIT',
                'RUT'
                ])->default('Cedula de Ciudadania');

            // Relaciones

            $table->foreignId('id_empresa')->constrained('empresas')->onDelete('cascade');
            $table->foreignId('id_ciudad')->constrained('ciudades')->onDelete('cascade');
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