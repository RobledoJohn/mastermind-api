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
use App\Http\Controllers\api\CategoriasController;
use App\Http\Controllers\api\equipoController;
use App\Http\Controllers\api\marcasController;
use App\Http\Controllers\api\modelosController;

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
//Route::delete('/empresas/{idEmpresa}', [empresaController::class, 'delete']); //NO SE USA PORQUE SE ACTUALIZA EL ESTADO A CERO

//Route::get('/empresa/{idEmpresa}', [empresaController::class, 'findById']); //NO SE USA PORQUE SE ALMACENA EN LOCAL STORAGE

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
Route::get('/{idEmpresa}/tecnico/{id}', [tecnicosController::class, 'findById']);
Route::post('/{idEmpresa}/tecnico', [tecnicosController::class, 'create']);
Route::put('/{idEmpresa}/tecnico/{id}', [tecnicosController::class, 'update']);
Route::delete('/{idEmpresa}/tecnico/{id}', [tecnicosController::class, 'delete']);

//esta ruta lista el inventario(productos) de una empresa en especifico
Route::get('/{idEmpresa}/inventario', [inventariosController::class, 'read']); //<------------------------------

//API EQUIPOS
//esta ruta lista los equipos de una empresa en especifico, aqui que se muestra??
Route::get('/{idEmpresa}/equipos/{idCliente}', [equipoController::class, 'read']); //leer todos los equipos de un cliente
Route::get('/{idCliente}/equipo/{idEquipo}', [equipoController::class, 'findById']); //leer un equipo en especifico
Route::post('/{idEmpresa}/equipos', [equipoController::class, 'create']);


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

//API CIUDADES
Route::get('/ciudades', [ciudadesController::class, 'read']);

//API TIPOS DE DOCUMENTOS
Route::get('/tiposDoc', [TiposDocumentosController::class, 'read']);

//API Categorias
Route::get('/categorias', [CategoriasController::class, 'read']);
Route::post('/categorias', [CategoriasController::class, 'create']);

//API MARCAS
Route::get('/marcas', [marcasController::class, 'read']);
Route::post('/marcas', [marcasController::class, 'create']);

//API Modelos
Route::get('/modelos', [modelosController::class, 'read']);
Route::post('/modelos', [modelosController::class, 'create']);

//enlace de seguimiento
Route::get('/seguimiento/{idEquipo}}', function(){return 'Seguimiento de equipo';});