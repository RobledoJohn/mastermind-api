<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use App\Models\Empresa;

class authController extends Controller
{
    public function login(Request $request){

        $email = $request->input('email');
        Log::info('Buscando empresa por email: ' . $email);

        // Busca la empresa por email
        $empresa = Empresa::where('email', $email)->first();

        if ($empresa) {
            // Registro en log
            Log::info('Empresa encontrada: ', $empresa->toArray());
            // Devuelve la empresa encontrada
            return response()->json($empresa, 200);
        } else {
            // Registro en log
            Log::warning('Empresa no encontrada con el email: ' . $email);
            // Si no se encuentra la empresa, devuelve un mensaje de error
            return response()->json(['mensaje' => 'Empresa no encontrada'], 404);
        }
    } 
}
