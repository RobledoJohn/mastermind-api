<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Cliente;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $cliente = new Cliente();
        $cliente->nombre = 'Test User';
        $cliente->identificacion = '1234567890';
        $cliente->email = 'test@user.com';
        $cliente->clave = '1234567890';
        $cliente->telefono = '3123121122';
        $cliente->avatar = 'img.jpeg';
        $cliente->direccion = 'Calle 123 # 123-123';
        $cliente->estado = '1';
        $cliente->enum_tipo_documento = '1';
        $cliente->save();

        
    }
}
