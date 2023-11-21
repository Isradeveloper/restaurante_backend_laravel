<?php

use App\Http\Controllers\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/tipo_identificacion', 'App\Http\Controllers\TipoIdentificacionController');
Route::resource('/cliente', 'App\Http\Controllers\ClienteController');
Route::resource('/direccion_cliente', 'App\Http\Controllers\DireccionClienteController');
Route::resource('/categoria_producto', 'App\Http\Controllers\CategoriaProductoController');
Route::resource('/metodo_pago', 'App\Http\Controllers\MetodoPagoController');
Route::resource('/estado_venta', 'App\Http\Controllers\EstadoVentaController');
Route::resource('/estado_domicilio', 'App\Http\Controllers\EstadoDomicilioController');
Route::resource('/repartidor', 'App\Http\Controllers\RepartidorController');
Route::resource('/producto', 'App\Http\Controllers\ProductoController');
Route::resource('/domicilio', 'App\Http\Controllers\DomicilioController');
Route::resource('/venta', 'App\Http\Controllers\VentaController');
Route::post('/registrar/usuario', [UsuariosController::class, 'register']);
Route::post('/login', [UsuariosController::class, 'login']);
Route::resource('/detalle_venta', 'App\Http\Controllers\DetalleVentaController');











