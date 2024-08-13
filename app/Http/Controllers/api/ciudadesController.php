<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ciudad;
use Illuminate\Http\Request;

class ciudadesController extends Controller
{
    public function read(){
        
        $ciudades = Ciudad::all();

        return response()->json($ciudades, 200);

    }
}
