<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
