<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Venta;

class ventasController extends Controller
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

        $ventas = Venta::where('ventas.id_empresa', $idEmpresa)
        ->join('detalle_ventas', 'ventas.id_detalle_venta', '=', 'detalle_ventas.id')
        ->join('productos', 'detalle_ventas.id_producto', '=', 'productos.id')
        ->select('ventas.*', 'detalle_ventas.*', 'productos.*')
        ->get();

        if ($ventas->isEmpty()) {
            $data = [
                'mensaje' => 'No hay ventas registradas',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($ventas, 200);
        } 
    }
}
