<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('auth\login');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/producto/{id}', 'ProductoController@index');

Route::post('/validacion', 'HomeController@validacion'); 
Route::post('/validacion-producto', 'HomeController@validacion_producto'); 
Route::post('/filtro_rfc', 'HomeController@filtro_rfc');
Route::post('/agregar_rfc', 'HomeController@agregar_rfc');
Route::post('/eliminar', 'HomeController@eliminar'); 
Route::post('/editar', 'HomeController@editar'); 

Route::get('/factura_info/{id}/{accion}', 'HomeController@factura_info');
//Route::post('/invoice ', 'HomeController@invoice');
Route::post('/imprimir_reporte', 'HomeController@imprimir_reporte');
Route::post('/clientes', 'HomeController@clientes');
Route::post('/reporte_general', 'HomeController@reporte_general');


Route::post('/send_mail', 'HomeController@send_mail');
//Route::get('/imprimir-reporte/{fecha}/{estatus}', 'HomeController@imprimir_reporte');

Route::post('/register', 'Auth\RegisterController@register'); 
//Route::post('/register', 'Auth\RegisterController@register'); 

Route::get('/prueba', 'HomeController@prueba'); 