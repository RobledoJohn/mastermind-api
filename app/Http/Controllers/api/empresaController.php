<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class empresaController extends Controller
{
    public function readEmpresas(){
        return 'lista de empresas';
    }

    public function createEmpresa(){
        return 'empresa creada';
    }

    public function readEmpresaById($idEmpresa){
        return 'empresa especifica';
    }

    public function updateEmpresa($idEmpresa){
        return 'empresa actualizada';
    }

    public function deleteEmpresa($idEmpresa){
        return 'empresa eliminada';
    }
}