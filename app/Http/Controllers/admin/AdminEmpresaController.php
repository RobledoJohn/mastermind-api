<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empresa;

class AdminEmpresaController extends Controller
{
    public function read(){

        $empresas = Empresa::all();

        if($empresas->isEmpty()){
            return view('NoEmpresas');
        }else{
            return view('Empresas', compact('empresas'));
        }
    }
}
