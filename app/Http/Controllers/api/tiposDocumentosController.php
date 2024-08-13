<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class tiposDocumentosController extends Controller
{
    public function read(){
        $documentos = [
            ['id' => 1, 'nombre' => 'Cedula de Ciudadania'],
            ['id' => 2, 'nombre' => 'Tarjeta de Identidad'],
            ['id' => 3, 'nombre' => 'Cedula de Extranjeria'],
            ['id' => 4, 'nombre' => 'Pasaporte'],
            ['id' => 5, 'nombre' => 'Registro Civil'],
            ['id' => 6, 'nombre' => 'NIT'],
            ['id' => 7, 'nombre' => 'RUT']
        ];

        return response()->json($documentos, 200);
    }
}
