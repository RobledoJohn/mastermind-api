<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Ingreso;

class ordenesController extends Controller
{
    public function read(){

        $ordenes = Ingreso::all();

        if($ordenes->isEmpty()){
            $data = [
                'mensaje' => 'No se encontraron ordenes',
                'status' => 200
            ];
            return response()->json($data, 404);
        }else{
            return response()->json($ordenes, 200);
        }
    }

    
}
