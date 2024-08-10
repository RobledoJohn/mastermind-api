<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Equipo;

use function Laravel\Prompts\select;

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

    public function findByDocumento($requestId, $documento){

        $idEmpresa = $requestId;
        $identificacion = $documento;
        
        if ($idEmpresa == null) {
            $data = [
                'mensaje' => 'No se envio id de empresa',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if ($identificacion == null) {
            $data = [
                'mensaje' => 'No se envio documento',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $cliente = Cliente::where('id_empresa', $idEmpresa)
                           ->where('identificacion', $identificacion)
                           ->select('clientes.id', 'clientes.nombre', 'clientes.identificacion', 'clientes.id_empresa as empresa')
                           ->first();

        if ($cliente) {

            $equipos = Equipo::where('id_cliente', $cliente->id)
                             ->with(['modelos','modelos.marca'])
                             ->get();

            if (!$equipos->isEmpty()) {

                $result = [ 
                        'cliente' => $cliente,
                        'equipos' => $equipos
                    ];
                
                return response()->json($result, 200); 
            }else{
                $data = [
                    'mensaje' => 'No se encontraron equipos',
                    'status' => 404
                ];
                return response()->json($data, 404);
            }

        }else {
            $data = [
                'mensaje' => 'No se encontro cliente',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
            
        

    }
}
