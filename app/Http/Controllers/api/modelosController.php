<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class modelosController extends Controller
{
    public function read(){
        $response = Modelo::all();
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

    public function create(Request $request){
        $validacion = Validator::make($request->all(),[
            'nombre' => 'required|string',
            'id_marca' => 'required|integer'
        ]);

        if ($validacion->fails()) {
            return response()->json($validacion->errors(), 400);
        }

        $modelo = Modelo::create([
            'nombre' => $request->nombre,
            'id_marca' => $request->id_marca
        ]);
        $modelo->save();

        return response()->json($modelo, 201);
    }
}
