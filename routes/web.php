<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*
//ruta para pagina de incio que muestra un mensaje
Route::get('/', function () {
    return "CRUD Iniciado";
});
*/