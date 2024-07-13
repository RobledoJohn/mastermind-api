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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('estado')->default(true);
            $table->interger('imei')->unique();

            $table->foreignId('id_cliente')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('id_modelo')->constrained('modelos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};