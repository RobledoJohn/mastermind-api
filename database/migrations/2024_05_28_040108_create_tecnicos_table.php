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
        Schema::create('tecnicos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20);
            $table->string('email')->unique();
            $table->string('clave');
            $table->integer('telefono')->unique();
            $table->string('avatar')->default('default-avatar.png');
            $table->boolean('estado')->default(true);
            $table->timestamps();

            //$table->foreignId('id_empresa')->constrained('empresas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos');
    }
};
