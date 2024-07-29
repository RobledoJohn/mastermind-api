<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;

use function Laravel\Prompts\select;

class ordenesController extends Controller
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
        
        $ordenes = Empresa::where('empresas.id', $idEmpresa)
        ->join('tecnicos', 'empresas.id', '=', 'tecnicos.id_empresa')
        ->join('ingresos', 'tecnicos.id', '=', 'ingresos.id_tecnico')
        ->select('ingresos.*', 'tecnicos.nombre as tecnico')
        ->get();

        return response()->json($ordenes, 200);   
        
        
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
