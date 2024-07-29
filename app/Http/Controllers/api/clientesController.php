<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

class clientesController extends Controller
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
        
        $clientes = Cliente::where('clientes.id_empresa', $idEmpresa)
        ->join('empresas', 'clientes.id_empresa', '=', 'empresas.id')
        ->select('empresas.nombre as empresa', 'clientes.*')
        ->get();        
        
        if ($clientes->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron ordenes',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($clientes, 200);
        }    

    }  
}
