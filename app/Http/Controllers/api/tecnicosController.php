<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function findById($idEmpresa, $idTecnico){
        
        if ($idEmpresa == null) {
            $data = [
                'mensaje' => 'No se envio id de empresa',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if ($idTecnico == null) {
            $data = [
                'mensaje' => 'No se envio id del Tecnico',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $tecnico = Tecnico::where('id_empresa', $idEmpresa)
                           ->where('id', $idTecnico)
                           ->first();

        if ($tecnico) {
            return response()->json($tecnico, 200);
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
            'id_empresa' => 'required',
            'nombre' => 'required|max:255',
            'email' => 'required|email',
            'clave' => 'required',
            'telefono' => 'required|digits:10'
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
        if (Tecnico::where('email', $request->email)->exists()) {
            $data = [
                'mensaje' => 'El email ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }


        if (Tecnico::where('telefono', $request->telefono)->exists()) {
            $data = [
                'mensaje' => 'El teléfono ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        // Creación
        $tecnico = Tecnico::create([
            'id_empresa' => $request->id_empresa,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'clave' => $request->clave,
            'telefono' => $request->telefono
        ]);

        return response()->json($tecnico, 201);
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
