<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authController extends Controller
{
    public function login(Request $request){

        $email = $request->email;
        $password = $request->password;

        return response()->json([
            'email' => $email,
            'password' => $password
        ]);

    } 
}
