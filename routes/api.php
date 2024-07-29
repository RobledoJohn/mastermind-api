<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\authController;

use App\Http\Controllers\api\empresaController;
use App\Http\Controllers\admin\AdminEmpresaController;
use App\Http\Controllers\api\clientesController;
use App\Http\Controllers\api\ordenesController;

use function Laravel\Prompts\alert;

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
Route::get('/ingresos/{idEmpresa}', [ordenesController::class, 'read']); // Trae los ingresos por id de la empresa que inicia sesion

Route::get('/{idEmpresa}/ingresos/{id}', function(){return 'obtener ingreso';});
Route::post('/{idEmpresa}/ingresos', function(){return 'ingreso creado';});
Route::put('/{idEmpresa}/ingresos/{id}', function(){return 'actualizar ingreso';});
Route::delete('/{idEmpresa}/ingresos/{id}', function(){return 'eliminar ingreso';});

//API CLIENTES
//esta ruta lista los clientes de una empresa en especifico
//el id de la empresa se envia por query (/clienntes?id_empresa=x), si no se envia query se listan todos los clientes del sistema
Route::get('/clientes', [clientesController::class, 'read']);
Route::get('/{idEmpresa}/clientes/{id}', function(){return 'obtener clientes';});
Route::post('/{idEmpresa}/clientes', function(){return 'cliente creado';});
Route::put('/{idEmpresa}/clientes/{id}', function(){return 'actualizar cliente';});
Route::delete('/{idEmpresa}/clientes/{id}', function(){return 'eliminar cliente';});

//API TECNICOS
//esta ruta lista los tecnicos de una empresa en especifico
Route::get('/{idEmpresa}/tecnicos', function(){return 'lista de tecnicos';});
Route::get('/{idEmpresa}/tecnicos/{id}', function(){return 'obtener tecnico';});
Route::post('/{idEmpresa}/tecnicos', function(){return 'tecnico creado';});
Route::put('/{idEmpresa}/tecnicos/{id}', function(){return 'actualizar tecnico';});
Route::delete('/{idEmpresa}/tecnicos/{id}', function(){return 'eliminar tecnico';});

//esta ruta lista el inventario(productos) de una empresa en especifico
Route::get('/{idEmpresa}/inventario', function(){return 'lista de productos';});

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
Route::get('/{idEmpresa}/ventas', function(){return 'lista de ventas';});
Route::get('/{idEmpresa}/ventas/{id}', function(){return 'obtener venta';});
Route::post('/{idEmpresa}/ventas', function(){return 'venta creado';});
Route::put('/{idEmpresa}/ventas/{id}', function(){return 'actualizar venta';});
Route::delete('/{idEmpresa}/ventas/{id}', function(){return 'eliminar venta';});

//enlace de seguimiento
Route::get('/seguimiento/{idCliente/{idEquipo}}', function(){return 'Seguimiento de equipo';});