<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoriasController extends Controller
{
    public function read(){

        $categoria = Categoria::all();

        if ($categoria->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron categorias',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($categoria, 200);
        }
    }

    public function create(Request $request){

        $request = request()->all();

        $validator = Validator::make($request, [
            'nombre' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 404);
        }

        $categoria = Categoria::create($request);

        return response()->json($categoria, 200);

    }
}
