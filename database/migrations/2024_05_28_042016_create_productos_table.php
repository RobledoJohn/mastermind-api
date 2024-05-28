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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('SKU', 20)->unique();
            $table->string('imagen')->default('default-image.png');
            $table->string('nombre');
            $table->string('descripcion');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->boolean('estado')->default(true);
            $table->timestamps();

            //$table->foreignId('id_empresa')->constrained('empresas');
            //$table->foreignId('id_categoria')->constrained('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
