<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Empresa;

class empresaController extends Controller
{
    public function read(){

        $empresa = Empresa::all();

        if($empresa->isEmpty()){
            $data = [
                'mensaje' => 'No se encontraron empresas',
                'status' => 200
            ];
            return response()->json($data, 404);
        }else{
            return response()->json($empresa, 200);
        }
    }

    public function create(Request $request){
        
        $validacion = Validator::make($request->all(), [ //se valida que los datos sean correctos y se contsruye el objeto validacion
            'nombre' => 'required|max:255',
            'nit' => 'required|digits:10|unique:empresas,nit',
            'email' => 'required|email|unique:empresas,email',
            'clave' => 'required|min:8|max:16',
            'direccion' => 'required|max:255',
            'telefono' => 'required|digits:10|unique:empresas,telefono'
        ]);

        if($validacion->fails()){ //si la validacion falla se retorna el error al cliente
            $data = [
                'mensaje' => 'Datos incorrectos',
                'errores' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);            
        }

        //SI LA VALIDACION ES CORRECTA SE VALIDAN LOS CAMPOS REQUERIDOS

        if(Empresa::where('email', $request->email)->exists()){ //se valida que el email no exista en la base de datos
            $data = [
                'mensaje' => 'El email ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }else if(Empresa::where('nit', $request->nit)->exists()){ //se valida que el nit no exista en la base de datos
                $data = [
                    'mensaje' => 'El nit ya existe',
                    'status' => 400
                ];
                return response()->json($data, 400);
        }else if(Empresa::where('telefono', $request->telefono)->exists()){ //se valida que el telefono no exista en la base de datos
            $data = [
                'mensaje' => 'El telefono ya existe',
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $empresa = Empresa::create([ //se crea el objeto empresa
            'nombre' => $request->nombre,
            'nit' => $request->nit,
            'email' => $request->email,
            'clave' => $request->clave,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono
        ]);

        $data = [
            'mensaje' => 'Empresa creada',
            'empresa' => $empresa,
            'status' => 201
        ];

        return response()->json($data, 201);

    }

    public function findById($idEmpresa){
        
        $empresa = Empresa::find($idEmpresa);

        if(!$empresa){
            $data = [
                'id'=> $idEmpresa,
                'mensaje' => 'Empresa no encontrada',
                'status' => 200
            ];
            return response()->json($data, 404);
        }else{
            return response()->json($empresa, 200);
        }

    }

    public function update(Request $request, $idEmpresa){
        
        $empresa = Empresa::find($idEmpresa);

        if(!$empresa){
            $data = [
                'id'=> $idEmpresa,
                'mensaje' => 'Empresa no encontrada',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [ //se valida que los datos sean correctos y se contsruye el objeto validacion
            'nombre' => 'required|max:255',
            'nit' => 'required|digits:10|unique:empresas,nit',
            'email' => 'required|email|unique:empresas,email',
            'clave' => 'required|min:8|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|digits:10|unique:empresas,telefono'
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

    public function updateOne(Request $request, $idEmpresa){
        
        $empresa = Empresa::find($idEmpresa);

        if(!$empresa){
            $data = [
                'id'=> $idEmpresa,
                'mensaje' => 'Empresa no encontrada',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $validacion = Validator::make($request->all(), [ //se valida que los datos sean correctos y se contsruye el objeto validacion
            'nombre' => 'max:255',
            'nit' => 'digits:10|unique:empresas,nit',
            'email' => 'email|unique:empresas,email',
            'clave' => 'min:8|max:255',
            'direccion' => 'max:255',
            'telefono' => 'digits:10|unique:empresas,telefono'
        ]);

        if($validacion->fails()){ //si la validacion falla se retorna el error al cliente
            $data = [
                'mensaje' => 'Datos incorrectos',
                'errores' => $validacion->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);            
        }

        if ($request->has('nombre')) {
            $empresa->nombre = $request->nombre;
        }
        if ($request->has('nit')) {
            $empresa->nit = $request->nit;
        }
        if ($request->has('email')) {
            $empresa->email = $request->email;
        }
        if ($request->has('clave')) {
            $empresa->clave = $request->clave;
        }
        if ($request->has('direccion')) {
            $empresa->direccion = $request->direccion;
        }
        if ($request->has('telefono')) {
            $empresa->telefono = $request->telefono;
        }

        $empresa->save();

        $data = [
            'mensaje' => 'Empresa actualizada',
            'empresa' => $empresa,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function delete($idEmpresa){

        $empresa = Empresa::find($idEmpresa);

        if(!$empresa){
            $data = [
                'id'=> $idEmpresa,
                'mensaje' => 'Empresa no encontrada',
                'status' => 200
            ];
            return response()->json($data, 404);
        }

        $empresa->delete();

        $data = [
            'mensaje' => 'Empresa eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}