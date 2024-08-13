<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\authController;

use App\Http\Controllers\api\empresaController;
use App\Http\Controllers\admin\AdminEmpresaController;
use App\Http\Controllers\api\clientesController;
use App\Http\Controllers\api\ordenesController;
use App\Http\Controllers\api\inventariosController;
use App\Http\Controllers\api\ventasController;
use App\Http\Controllers\api\tecnicosController;
use App\Http\Controllers\api\ciudadesController;
use App\Http\Controllers\api\TiposDocumentosController;

//CRUD(DESARROLLADOR)

//creando rutas para administrador de aplicacion, para poder hacer crud a las empresas que registren.
Route::get('/admin/empresas', [AdminEmpresaController::class, 'getEmpresas'])->name('admin.empresas'); //laravel
Route::get('/admin/equipos', [AdminEmpresaController::class, 'getEquipos']); //laravel
Route::get('/admin/tecnicos', [AdminEmpresaController::class, 'getTecnicos'])->name('admin.tecnicos'); //laravel
Route::get('/admin/ingresos', [AdminEmpresaController::class, 'getOrdenes'])->name('admin.ordenes'); //laravel
Route::get('/admin/productos', [AdminEmpresaController::class, 'getProductos']); //laravel
Route::get('/admin/ventas', [AdminEmpresaController::class, 'getVentas']); //laravel

//LOGIN

Route::post('/auth', [authController::class, 'login']);
//Route::post('/recuperar', function(){return alert('activo');});

//CRUD EMPRESAS de usuario

Route::get('/empresas', [empresaController::class, 'findAll']); //busqueda para ver json
Route::post('/empresas', [empresaController::class, 'create']); //ruta para crear cuenta de empresa
Route::put('/empresas', [empresaController::class, 'update']); //ruta para actualizar datos de empresa

//Route::get('/empresa/{idEmpresa}', [empresaController::class, 'findById']); //NO SE USA PORQUE SE ALMACENA EN LOCAL STORAGE
//Route::patch('/empresas/{idEmpresa}', [empresaController::class, 'updateOne']);
//Route::delete('/empresas/{idEmpresa}', [empresaController::class, 'delete']); //NO SE USA PORQUE SE ACTUALIZA EL ESTADO A CERO


//CRUD DEMAS ROLES (CLIENTE-TECNICO)

//esta ruta lista los servicios ingresados que no han sido aceptados por ningun tecnico
//Route::get('/ingresos', [ordenesController::class, 'read']);
Route::get('/{idEmpresa}/ingresos', [ordenesController::class, 'read']); // Trae los ingresos por id de la empresa que inicia sesion
Route::post('/{idEmpresa}/ingresos', [ordenesController::class, 'create']); //ruta para crear ingreso
Route::get('/{idEmpresa}/ingresos/{id}', [ordenesController::class, 'findById']);
Route::put('/{idEmpresa}/ingresos/{id}', [ordenesController::class, 'update']);
Route::delete('/{idEmpresa}/ingresos/{id}', [ordenesController::class, 'delete']);


//API CLIENTES
//esta ruta lista los clientes de una empresa en especifico
//el id de la empresa se envia por query (/clienntes?id_empresa=x), si no se envia query se listan todos los clientes del sistema
Route::get('/{idEmpresa}/clientes', [clientesController::class, 'read']);
Route::get('/{idEmpresa}/cliente/{id}', [clientesController::class, 'findById']);
Route::get('/{idEmpresa}/clientes/{documento}', [clientesController::class, 'findByDocumento']);
Route::post('/{idEmpresa}/clientes', [clientesController::class, 'create']);
Route::put('/{idEmpresa}/cliente/{id}', [clientesController::class, 'update']);
Route::delete('/{idEmpresa}/cliente/{id}', [clientesController::class, 'delete']);



//API TECNICOS
//esta ruta lista los tecnicos de una empresa en especifico
Route::get('/{idEmpresa}/tecnicos', [tecnicosController::class, 'read']);
Route::get('/{idEmpresa}/tecnicos/{id}', function(){return 'obtener tecnico';});
Route::post('/{idEmpresa}/tecnicos', function(){return 'tecnico creado';});
Route::put('/{idEmpresa}/tecnicos/{id}', function(){return 'actualizar tecnico';});
Route::delete('/{idEmpresa}/tecnicos/{id}', function(){return 'eliminar tecnico';});

//esta ruta lista el inventario(productos) de una empresa en especifico
Route::get('/{idEmpresa}/inventario', [inventariosController::class, 'read']);

//API EQUIPOS
//esta ruta lista los equipos de una empresa en especifico, aqui que se muestra??
Route::get('/{idEmpresa}/equipos', function(){return 'lista de equipos';});
Route::get('/{idEmpresa}/equipos/{id}', function(){return 'obtener equipo';});
Route::post('/{idEmpresa}/equipos', function(){return 'crear equipo';});
Route::put('/{idEmpresa}/equipos/{id}', function(){return 'actualizar equipo';});
Route::delete('/{idEmpresa}/equipos/{id}', function(){return 'eliminar equipo';});

//esta ruta lista las ordenes activas, es decir trabajos que se encuentran en ejecucion por los tecnicos
Route::get('/ordenes', function(){return 'lista de ordenes';});
Route::get('/{idEmpresa}/ordenes/{id}', function(){return 'obtener orden';});
Route::post('/{idEmpresa}/ordenes', function(){return 'orden creado';});
Route::put('/{idEmpresa}/ordenes/{id}', function(){return 'actualizar orden';});
Route::delete('/{idEmpresa}/ordenes/{id}', function(){return 'eliminar orden';});


//esta lista muestra como venta las ordenes de servicio finalizadas con el monto total y los repuestos del inventario que fueron usados
Route::get('/{idEmpresa}/ventas', [ventasController::class, 'read']);
Route::get('/{idEmpresa}/ventas/{id}', function(){return 'obtener venta';});
Route::post('/{idEmpresa}/ventas', function(){return 'venta creado';});
Route::put('/{idEmpresa}/ventas/{id}', function(){return 'actualizar venta';});
Route::delete('/{idEmpresa}/ventas/{id}', function(){return 'eliminar venta';});

Route::get('/ciudades', [ciudadesController::class, 'read']);
Route::get('/tiposDoc', [TiposDocumentosController::class, 'read']);

//enlace de seguimiento
Route::get('/seguimiento/{idEquipo}}', function(){return 'Seguimiento de equipo';});