<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Ingreso;
use App\Models\Tecnico;
use Illuminate\Http\Request;

class ordenesController extends Controller
{
    public function read(Request $request){

        //tomamos el id de la empresa que se envia por query
        $empresaId = $request->id;

        /*Se verifica que el id sea enviado como parametro */
        if ($empresaId == null) {
            $data = [
                'mensaje' => 'No se envio id de empresa',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        //BUSCAR POR ID DE EMPRESA, Y DEVOLVER TODAS LAS ORDENES DE ESE ID
        $ordenes = Empresa::find($empresaId)->tecnicos->get(0)->ingresos;

        if ($ordenes->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron ordenes',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($ordenes, 200);
        }
    }    
}
