<?php

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

// Route::get('/tipo_identificacion', 'App\Http\Controllers\TipoIdentificacionController@index');
// Route::post('/tipo_identificacion', 'App\Http\Controllers\TipoIdentificacionController@store');
// Route::get('/tipo_identificacion/{tipoIdentificacion}', 'App\Http\Controllers\TipoIdentificacionController@show');
// Route::put('/tipo_identificacion/{tipoIdentificacion}', 'App\Http\Controllers\TipoIdentificacionController@update');

Route::resource('/tipo_identificacion', 'App\Http\Controllers\TipoIdentificacionController');


