<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class equipoController extends Controller
{
    public function read($idEmpresa, $idCliente){
        
        /*Se verifica que el id sea enviado como parametro */
        if ($idEmpresa == null) {
            $data = [
                'mensaje' => 'No se envio id de empresa',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $response = Equipo::where('equipos.id_cliente', $idCliente)
        ->join('modelos', 'equipos.id_modelo', '=', 'modelos.id')
        ->join('marcas', 'modelos.id_marca', '=', 'marcas.id')
        ->join('clientes', 'equipos.id_cliente', '=', 'clientes.id')
        ->select('equipos.*', 'modelos.nombre as modelo', 'marcas.nombre as marca', 'clientes.nombre as cliente')
        ->get();       
        
        if ($response->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron equipos',
                'status' => 404
            ];
            return response()->json($data, 404);
        } else {
            return response()->json($response, 200);
        }    

    }

    public function findById($idCliente, $idEquipo){
        
        if ($idCliente == null) {
            $data = [
                'mensaje' => 'No se envio id de empresa',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if ($idEquipo == null) {
            $data = [
                'mensaje' => 'No se envio id del Tecnico',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $equipo = Equipo::where('equipos.id_cliente', $idCliente)
            ->where('equipos.id', $idEquipo)
            ->join('modelos', 'equipos.id_modelo', '=', 'modelos.id')
            ->join('marcas', 'modelos.id_marca', '=', 'marcas.id')
            ->join('clientes', 'equipos.id_cliente', '=', 'clientes.id')
            ->select('equipos.*', 'modelos.nombre as modelo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'clientes.nombre as cliente')
            ->get();

        if ($equipo) {
            return response()->json($equipo, 200);
        }else{
            $data = [
                'mensaje' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
    }

    public function create(Request $request){

        $validacion = Validator::make($request->all(), [
            'id_cliente' => 'required',
            'id_modelo' => 'required',
            'id_marca' => 'required', 
            'enum_tipo_equipos' => 'required',
        ]);

        if ($validacion->fails()) { // Si la validación falla se retorna el error al cliente
            $data = [
                'mensaje' => 'Datos incorrectos',
                'errores' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        
        // Validaciones de existencia
        if (Marca::where('id_marca', $request->id_marca)->exists()) {
            
            $data = [
                'mensaje' => 'La marca ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }else{
            $data = [
                'mensaje' => 'La marca no existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }


        if (Modelo::where('id_modelo', $request->id_modelo)->exists()) {

            $data = [
                'mensaje' => 'El modelo existe',
                'status' => 201
            ];

            return response()->json($data, 200);
        }else{
            $data = [
                'mensaje' => 'El modelo no existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Creación
        $equipo = Equipo::create([
            'id_cliente' => $request->id_cliente,
            'id_modelo' => $request->id_modelo,
            'id_marca' => $request->id_marca, 
            'enum_tipo_equipos' => $request->enum_tipo_equipos,
        ]);

        return response()->json($equipo, 201);
    }

    public function update(Request $request, $idEmpresa, $idTecnico){

        $tecnico = Tecnico::where('id_empresa', $idEmpresa)
                          ->where('id', $idTecnico)
                          ->first();

        if (!$tecnico) {
            $data = [
                'mensaje' => 'Tecnico no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [ //se valida que los datos sean correctos y se contsruye el objeto validacion
            'nombre' => 'required|max:255',
            'email' => [Rule::unique('tecnicos')->ignore($idTecnico)],
            'clave' => 'required|min:8|max:255',
            'telefono' => [Rule::unique('tecnicos')->ignore($idTecnico)]
        ]);

        if($validacion->fails()){ //si la validacion falla se retorna el error al cliente
            $data = [
                'mensaje' => 'Datos incorrectos',
                'errores' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);            
        }

        $tecnico->nombre = $request->nombre;
        $tecnico->email = $request->email;
        $tecnico->clave = $request->clave;
        $tecnico->telefono = $request->telefono;

        $tecnico->save();

        $data = [
            'mensaje' => 'Cliente actualizado',
            'empresa' => $tecnico,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

    public function delete($idEmpresa, $idTecnico){

        $tecnico = Tecnico::where('id_empresa', $idEmpresa)
                          ->where('id', $idTecnico)
                          ->first();

        if(!$tecnico){
            $data = [
                'id'=> $idTecnico,
                'mensaje' => 'Cliente no encontrado',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $tecnico->delete();

        $data = [
            'mensaje' => 'Cliente Eliminado',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}