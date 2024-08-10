<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Ingreso;
use Illuminate\Http\Request;

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

    public function create(Request $request){

        if($request->id_cliente == null || $request->id_equipo == null){
            $data = [
                'mensaje' => 'Faltan datos',
                'status' => 404
            ];
            return response()->json($data, 404);
        }else{
            $ingreso = Ingreso::create([
                'id_tecnico' => $request->id_tecnico,
                'id_equipo' => $request->id_equipo,
                'descripcion' => $request->descripcion,
                'enum_estado_reparacion' => $request->enum_estado_reparacion,
                'enlace_seguimiento' => $request->enlace_seguimiento,
            ]);

            $data = [
                'mensaje' => 'Ingreso creado',
                'status' => 200,
                'request' => $ingreso
            ];

            return response()->json($ingreso, 200);
        }
        
    }   
    
    public function findById($idEmpresa,$idIngreso){

        if($idEmpresa == "null" || $idIngreso == "null"){
            $data = [
                'mensaje' => 'No se envio id de empresa o id de ingreso',
                'status' => 404
            ];
            return response()->json($data, 404);
        }else{
            $orden = Empresa::where('empresas.id', $idEmpresa)
            ->join('tecnicos', 'empresas.id', '=', 'tecnicos.id_empresa')
            ->join('ingresos', 'tecnicos.id', '=', 'ingresos.id_tecnico')
            ->where('ingresos.id', "=", $idIngreso)
            ->join('equipos', 'ingresos.id_equipo', '=', 'equipos.id')
            ->join('modelos', 'equipos.id_modelo', '=', 'modelos.id')
            ->join('marcas', 'modelos.id_marca', '=', 'marcas.id')
            ->join('clientes', 'equipos.id_cliente', '=', 'clientes.id')
            ->select('ingresos.*', 'clientes.nombre as cliente', 'tecnicos.nombre as tecnico', 'modelos.nombre as modelo', 'marcas.nombre as marca')
            ->first();
    
            if ($orden == null) {
                $data = [
                    'mensaje' => 'No se encontraron ordenes con el id:'. $idIngreso,
                    'status' => 404
                ];
                return response()->json($data, 404);
            }
            return response()->json($orden, 200);
        }
    }          
}
