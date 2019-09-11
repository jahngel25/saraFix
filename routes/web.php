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
    return view('welcome');
})->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/dataHome', 'PublicController@indexHomeWel')->name('dataHome');
Route::get('/404', 'ErrorController@error404')->name('error404');


Route::get('/registreProvider', 'Auth\RegisterController@registerProvider')->name('registerProvider');
Route::get('/servicios/{id}', 'PublicController@traerServicios')->name('servicios');
Route::get('/ordenServicio/{id}', 'ControllerOrdenServicio@contratar')->name('ordenServicio');
Route::post('crearOrdenServicio','ControllerOrdenServicio@crear')->name('crearOrdenServicio');


Route::group(['middleware' => 'Administrador','prefix' => 'Administrador'], function () {
    Route::get('/home', 'AdministradorController@index')->name('homeAdmin');
    Route::get('/Area', 'ControllerArea@index')->name('area');
    Route::get('/formularioCreacion', 'ControllerArea@create')->name('frmCreacion');
    Route::post('/crearArea', 'ControllerArea@store')->name('crearArea');
    Route::get('/Servicio', 'ControllerNuevosServicios@index')->name('servicioList');
    Route::get('/crearServicio', 'ControllerNuevosServicios@create')->name('frmCreacionServicio');
    Route::post('/crearServicio', 'ControllerNuevosServicios@store')->name('crearServicio');
});

Route::group(['middleware' => 'Cliente','prefix' => 'Cliente'], function () {
    Route::get('/home', 'ClienteController@index')->name('homeCliente');
});

Route::group(['middleware' => 'Todero','prefix' => 'Todero'], function () {
    Route::get('/home', 'ToderoController@index')->name('homeTodero');
});






