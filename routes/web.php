<?php

use App\Http\Controllers\api\authController;
use Illuminate\Support\Facades\Route;

/* ruta de la pagina de inicio que llama la vista welcome.blade.php
Route::get('/', function () {
    return view('welcome');
});
*/

//ruta para pagina de incio que muestra un mensaje
Route::get('/', function () {
    return "home";
});

Route::post('/login', [authController::class, 'login']);