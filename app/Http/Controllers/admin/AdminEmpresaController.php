<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empresa;
use App\Models\Equipo;

class AdminEmpresaController extends Controller
{
    public function getEmpresas(){

        $empresas = Empresa::all();

        if($empresas->isEmpty()){
            return view('NoEmpresas');
        }else{
            return view('Empresas', compact('empresas'));
        }
    }
    public function getEquipos(){

        $equipos = Equipo::with('clientes')->get();

        if($equipos->isEmpty()){
            return response()->json($equipos);
        }else{
            return response()->json($equipos);
        }
    }
}
