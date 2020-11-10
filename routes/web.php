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
Route::get('/contactenos', 'PublicController@indexContactenos')->name('contactenos');
Route::post('/crearContactenos', 'PublicController@createContactenos')->name('crearContactenos');
Route::post('/crearCotizacion', 'PublicController@createCotizacion')->name('crearCotizacion');
Route::get('/downloadTer/{name}', 'PublicController@getDownload')->name('downloadTer');
Route::get('/ordenServicio/{id}/{guid}/{id_area}', 'ControllerOrdenServicio@contratar')->name('ordenServicio');
Route::post('crearOrdenServicio','ControllerOrdenServicio@crear')->name('crearOrdenServicio');
Route::get('deleteOrdenServicio/{key}/{id}/{guid}/{id_area}','ControllerOrdenServicio@delete')->name('deleteOrdenServicio');


Route::group(['middleware' => 'Administrador','prefix' => 'Administrador'], function () {
    Route::get('/home', 'AdministradorController@index')->name('homeAdmin');
    //routes Area
    Route::get('/Area', 'ControllerArea@index')->name('area');
    Route::get('/editArea/{id}', 'ControllerArea@edit')->name('areaEdit');
    Route::post('/actionEditArea/{id}', 'ControllerArea@update')->name('actionEditArea');
    Route::get('/formularioCreacion', 'ControllerArea@create')->name('frmCreacion');
    Route::post('/crearArea', 'ControllerArea@store')->name('crearArea');
    Route::get('/infoUser/{id}','AdministradorController@infoUser')->name('infoUser');

    //routes servicio
    Route::get('/Servicio', 'ControllerNuevosServicios@index')->name('servicioList');
    Route::get('/crearServicio', 'ControllerNuevosServicios@create')->name('frmCreacionServicio');
    Route::post('/crearServicio', 'ControllerNuevosServicios@store')->name('crearServicio');
    Route::get('/editServicio/{id}', 'ControllerNuevosServicios@edit')->name('servicioEdit');
    Route::post('/actionEditServicio/{id}', 'ControllerNuevosServicios@update')->name('actionEditServicio');


    Route::get('/usuarioConstructor','AdministradorController@indexUsuarioConstrutor')->name('usuarioConstructor');
    Route::get('/updateEstado/{id}','AdministradorController@updateEstado')->name('updateEstado');
    Route::get('/usuarioCliente','AdministradorController@indexUsuarioCliente')->name('usuarioCliente');
    Route::get('/contactenos','AdministradorController@indexContactenos')->name('contactenosAdmin');
    Route::post('/emailContactenos','AdministradorController@emailContactenos')->name('emailContactenos');
    Route::post('/emailCotizacion','AdministradorController@emailCotizacion')->name('emailCotizacion');
    Route::get('/cotizaciones','AdministradorController@indexCotizaciones')->name('cotizacionesAdmin');
    Route::get('/downloadAdmin/{name}', 'AdministradorController@getDownload')->name('downloadAdmin');
    Route::get('/retiros', 'ControllerRetiro@infoRetiros')->name('solicitudRetiros');
    Route::get('/updateRetiros/{id}', 'ControllerRetiro@updateRetiro')->name('updateEstadoRetiro');
    Route::get('/infoServiciosAdmin', 'AdministradorController@infoServicio')->name('infoServiciosAdmin');

});

Route::group(['middleware' => 'Cliente','prefix' => 'Cliente'], function () {
    Route::get('/home', 'ClienteController@index')->name('homeCliente');
    Route::get('/compras', 'ClienteController@compras')->name('compras');
    Route::get('infoServicios/{id}','ClienteController@informacionServicio')->name('infoServi');
    Route::post('calificar', 'ClienteController@calificar')->name('calificarTodero');
    Route::get('/infoUser/{id}','ClienteController@infoUser')->name('infoUserAsig');
    Route::get('/acepted/{id}', 'ClienteController@Acepted')->name('acepted');
    Route::get('/rejected/{id}', 'ClienteController@Rejected')->name('rejected');
    Route::get('/pending/{id}', 'ClienteController@Pending')->name('pending');

});

Route::group(['middleware' => 'Todero','prefix' => 'Todero'], function () {

    Route::get('/home', 'ToderoController@index')->name('homeTodero');
    Route::post('/aceptarServicio','ControllerRelationOrdenUser@create')->name('aceptarServicio');
    Route::post('/informacionAdicional','ToderoController@createInformacionAdicional')->name('informacionAdicional');
    Route::post('/informacionAdicionalEdit','ToderoController@editInformacionAdicional')->name('informacionAdicionalEdit');
    Route::get('/traerDepartamento/{id}','ToderoController@traerDepartamento')->name('traerDepartamento');
    Route::get('/traerCiudad/{id}','ToderoController@traerCiudad')->name('traerCiudad');
    Route::get('infoServicios/{id}','ToderoController@informacionServicio')->name('infoServicios');
    Route::get('servicio/realizados','ToderoController@trabajosRealizados')->name('realizados');
    Route::get('servicio/proceso','ToderoController@trabajosProceso')->name('proceso');
    Route::post('servicio/terminar','ControllerRelationOrdenUser@terminarTrabajo')->name('terminar');
    Route::post('calificar', 'ToderoController@calificar')->name('calificarCliente');
    Route::get('ingresos', 'ToderoController@ingresos')->name('ingresos');
    Route::get('/download/{name}', 'AdministradorController@getDownload')->name('download');
    Route::post('/retiros', 'ControllerRetiro@retiros')->name('retiros');
    Route::get('/editarPerfil','ToderoController@editPerfil')->name('editPerfil');

});





