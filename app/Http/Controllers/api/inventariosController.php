<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class inventariosController extends Controller
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

        $inventario = Producto::where('productos.id_empresa', $idEmpresa)
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->select('productos.*', 'categorias.nombre as categoria')
        ->get();

        if ($inventario->isEmpty()) {
            $data = [
                'mensaje' => 'No hay inventario',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($inventario, 200);
        } 
    }
}
