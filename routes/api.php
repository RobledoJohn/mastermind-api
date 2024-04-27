<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\empresaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//CRUD(DESARROLLADOR)

//LOGIN

Route::post('/autenticacion', function(){
    return 'Datos de usuario enviados';
});

Route::post('/registro', function(){
    return 'usuario creado';
});

Route::post('/recuperar', function(){
    return 'correo enviado';
});

//creando rutas para administrador de aplicacion, para poder hacer crud a las empresas que re segistren.
Route::get('/empresas', [empresaController::class, 'readEmpresas']);
Route::post('/empresas', [empresaController::class, 'createEmpresa']);
Route::get('/{idEmpresa}/empresas', [empresaController::class, 'readEmpresaById']);
Route::put('/{idEmpresa}/empresas', [empresaController::class, 'updateEmpresa']);
Route::delete('/{idEmpresa}/empresas', [empresaController::class, 'deleteEmpresa']);


//CRUD DEMAS ROLES (ADMIN-CLIENTE-TECNICO)

//API CLIENTES
//esta ruta lista los clientes de una empresa en especifico
Route::get('/{idEmpresa}/clientes', function(){
    return 'lista de clientes';
});

Route::get('/{idEmpresa}/clientes/{id}', function(){
    return 'obtener clientes';
});

Route::post('/{idEmpresa}/clientes', function(){
    return 'cliente creado';
});

Route::put('/{idEmpresa}/clientes/{id}', function(){
    return 'actualizar cliente';
});

Route::delete('/{idEmpresa}/clientes/{id}', function(){
    return 'eliminar cliente';
});

//API TECNICOS
//esta ruta lista los tecnicos de una empresa en especifico
Route::get('/{idEmpresa}/tecnicos', function(){
    return 'lista de tecnicos';
});

Route::get('/{idEmpresa}/tecnicos/{id}', function(){
    return 'obtener tecnico';
});

Route::post('/{idEmpresa}/tecnicos', function(){
    return 'tecnico creado';
});

Route::put('/{idEmpresa}/tecnicos/{id}', function(){
    return 'actualizar tecnico';
});

Route::delete('/{idEmpresa}/tecnicos/{id}', function(){
    return 'eliminar tecnico';
});

//esta ruta lista el inventario(productos) de una empresa en especifico
Route::get('/{idEmpresa}/inventario', function(){
    return 'lista de productos';
});

//API EQUIPOS
//esta ruta lista los equipos de una empresa en especifico, aqui que se muestra??
Route::get('/{idEmpresa}/equipos', function(){
    return 'lista de equipos';
});

Route::get('/{idEmpresa}/equipos/{id}', function(){
    return 'obtener equipo';
});

Route::post('/{idEmpresa}/equipos', function(){
    return 'crear equipo';
});

Route::put('/{idEmpresa}/equipos/{id}', function(){
    return 'actualizar equipo';
});

Route::delete('/{idEmpresa}/equipos/{id}', function(){
    return 'eliminar equipo';
});

//esta ruta lista los servicios ingresados que no han sido aceptados por ningun tecnico
Route::get('/{idEmpresa}/ingresos', function(){
    return 'lista de ingresos';
});

Route::get('/{idEmpresa}/ingresos/{id}', function(){
    return 'obtener ingreso';
});

Route::post('/{idEmpresa}/ingresos', function(){
    return 'ingreso creado';
});

Route::put('/{idEmpresa}/ingresos/{id}', function(){
    return 'actualizar ingreso';
});

Route::delete('/{idEmpresa}/ingresos/{id}', function(){
    return 'eliminar ingreso';
});


//esta ruta lista las ordenes activas, es decir trabajos que se encuentran en ejecucion por los tecnicos
Route::get('/{idEmpresa}/ordenes', function(){
    return 'lista de ordenes';
});

Route::get('/{idEmpresa}/ordenes/{id}', function(){
    return 'obtener orden';
});

Route::post('/{idEmpresa}/ordenes', function(){
    return 'orden creado';
});

Route::put('/{idEmpresa}/ordenes/{id}', function(){
    return 'actualizar orden';
});

Route::delete('/{idEmpresa}/ordenes/{id}', function(){
    return 'eliminar orden';
});


//esta lista muestra como venta las ordenes de servicio finalizadas con el monto total y los repuestos del inventario que fueron usados
Route::get('/{idEmpresa}/ventas', function(){
    return 'lista de ventas';
});

Route::get('/{idEmpresa}/ventas/{id}', function(){
    return 'obtener venta';
});

Route::post('/{idEmpresa}/ventas', function(){
    return 'venta creado';
});

Route::put('/{idEmpresa}/ventas/{id}', function(){
    return 'actualizar venta';
});

Route::delete('/{idEmpresa}/ventas/{id}', function(){
    return 'eliminar venta';
});

//enlace de seguimiento

Route::get('/seguimiento/{idCliente/{idEquipo}}', function(){
    return 'Seguimiento de equipo';
});