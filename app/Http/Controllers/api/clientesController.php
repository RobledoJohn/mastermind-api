<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cliente;

class clientesController extends Controller
{
    public function read(){
 /* 
        // Obtén el parámetro 'empresa_id' de la solicitud
        $empresaId = $request->query('empresa_id');
        
        // Si se proporciona 'empresa_id', filtra los clientes por este campo
        if ($empresaId) {
            $clientes = Cliente::where('empresa_id', $empresaId)->get();
        } else {
            // Si no se proporciona 'empresa_id', obtiene todos los clientes
            $clientes = Cliente::all();
        }
        
        // Devuelve los clientes como respuesta JSON
        return response()->json($clientes);
       */
    }
}
