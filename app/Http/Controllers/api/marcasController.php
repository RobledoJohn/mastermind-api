<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class marcasController extends Controller
{
    public function read(){
        $response = Marca::all();
        if ($response->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron marcas',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($response, 200);
        }
    }

    public function create(){
        $data = request()->validate([
            'nombre' => 'required|string'
        ]);

        $marca = Marca::create([
            'nombre' => $data['nombre']
        ]);
        $marca->save();

        return response()->json($marca, 201);
    }
}
