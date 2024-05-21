<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function login(Request $request){

        

        $validacion = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if ($validacion->fails()) {
            $data = [
                'status' => 'error',
                'code' => 400,
                'message' => 'Usuario no se ha podido identificar',
                'errors' => $validacion->errors()
            ];
            return response()->json($validacion->errors(), 400);
        };
    } 
}
