<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                    'mensaje' => 'Cliente no tiene equipos registrados',
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

    public function create(Request $request){

        $validacion = Validator::make($request->all(), [
            'id_empresa' => 'required',
            'nombre' => 'required|max:255',
            'identificacion' => 'required|digits:10',
            'email' => 'required|email',
            'clave' => 'required',
            'telefono' => 'required|digits:10',
            'direccion' => 'required',
            'enum_tipo_documento' => 'required',
            'id_ciudad' => 'required'
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
        if (Cliente::where('email', $request->email)->exists()) {
            $data = [
                'mensaje' => 'El email ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }


        if (Cliente::where('telefono', $request->telefono)->exists()) {
            $data = [
                'mensaje' => 'El teléfono ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        
        if (Cliente::where('identificacion', $request->identificacion)->exists()) {
            $data = [
                'mensaje' => 'Usuario con numero de identificacion ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }
        // Creación del cliente
        $cliente = Cliente::create([
            'id_empresa' => $request->id_empresa,
            'nombre' => $request->nombre,
            'identificacion' => $request->identificacion,
            'email' => $request->email,
            'clave' => $request->clave,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'enum_tipo_documento' => $request->enum_tipo_documento,
            'id_ciudad' => $request->id_ciudad
        ]);

        return response()->json($cliente, 201);
    }

    public function update(Request $request, $id_empresa, $id_cliente){

        $cliente = Cliente::where('id_empresa', $id_empresa)
                          ->where('id', $id_cliente)
                          ->first();

        if (!$cliente) {
            $data = [
                'mensaje' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [ //se valida que los datos sean correctos y se contsruye el objeto validacion
            'nombre' => 'required|max:255',
            'nit' => [Rule::unique('empresas')->ignore($id)],
            'email' => [Rule::unique('empresas')->ignore($id)],
            'clave' => 'required|min:8|max:255',
            'direccion' => 'required|max:255',
            'telefono' => [Rule::unique('empresas')->ignore($id)]
        ]);

        if($validacion->fails()){ //si la validacion falla se retorna el error al cliente
            $data = [
                'mensaje' => 'Datos incorrectos',
                'errores' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);            
        }

        $empresa->nombre = $request->nombre;
        $empresa->nit = $request->nit;
        $empresa->email = $request->email;
        $empresa->clave = $request->clave;
        $empresa->avatar = $request->avatar;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;

        $empresa->save();

        $data = [
            'mensaje' => 'Empresa actualizada',
            'empresa' => $empresa,
            'status' => 200
        ];

        return response()->json($data, 200);

    }

}
