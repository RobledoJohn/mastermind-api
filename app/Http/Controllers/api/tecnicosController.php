<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tecnico;

class tecnicosController extends Controller
{
    public function read($requestId){

        //tomamos el id de la empresa que se envia por query
        $idEmpresa = $requestId;
        
        /*Se verifica que el id sea enviado como parametro */
        if ($idEmpresa == null) {
            $data = [
                'mensaje' => 'No se envio id de empresa',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $response = Tecnico::where('tecnicos.id_empresa', $idEmpresa)
        ->get();        
        
        if ($response->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron ordenes',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($response, 200);
        }    

    }
}
