<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Empresa;
use App\Models\Equipo;
use App\Models\Ingreso;
use App\Models\Producto;
use App\Models\Tecnico;
use App\Models\Venta;

class AdminEmpresaController extends Controller
{
    public function getEmpresas(){

        $empresas = Empresa::all();

        if($empresas->isEmpty()){
            return view('NoEmpresas');
        }else{
            //return response()->json($empresas);
            return view('Empresas', compact('empresas')); //retorna vista de empresas
        }
    }
    public function getEquipos(){

        $equipos = Equipo::with(['clientes', 'modelos.marca'])->get();

        if($equipos->isEmpty()){
            return response()->json($equipos);
        }else{
            return response()->json($equipos);
        }
    }
    public function getTecnicos(){

        $tecnicos = Tecnico::with('empresas')->get();
        //$tecnicos = Tecnico::all();

        if($tecnicos->isEmpty()){
            return response()->json($tecnicos);
        }else{
            //return response()->json($tecnicos);
            return view('Tecnicos', compact('tecnicos')); //retorna vista de tecnicos
        }
    }
    public function getOrdenes(){

        $ordenes = Ingreso::with(['tecnicos', 'equipos.clientes', 'equipos.modelos'])->get();
        //$ingresos = Ingreso::all();

        if($ordenes->isEmpty()){
            return response()->json($ordenes);
        }else{
            //return response()->json($ordenes);
            return view('Ordenes', compact('ordenes')); //retorna vista de ordenes
        }
    }
    public function getProductos(){

        $productos = Producto::with(['categorias'])->get();
        //$productos = Producto::all();

        if($productos->isEmpty()){
            return response()->json($productos);
        }else{
            return response()->json($productos);
        }
    }
    public function getVentas(){

        $ventas = Venta::with(['detalle_venta.productos', 'detalle_venta.ingresos.equipos.clientes', 'detalle_venta.ingresos.equipos.modelos'])->get();
        //$ventas = Venta::all();

        if($ventas->isEmpty()){
            return response()->json($ventas);
        }else{
            return response()->json($ventas);
        }
    }
}
