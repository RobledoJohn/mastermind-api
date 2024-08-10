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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20);
            $table->bigInteger('nit')->unique();
            $table->string('email')->unique();
            $table->string('clave');
            $table->string('avatar')->default('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzo6yD6aSlWOfjPLT8HS091jJ_vIF_e-evL-aCWR0zVLJlLBnFcxNzmbpHUXpNsTC6XpQ&usqp=CAU');
            $table->string('direccion', 100);
            $table->bigInteger('telefono')->unique();
            $table->tinyInteger('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
