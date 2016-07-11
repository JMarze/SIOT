<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/', function () {
        return view('welcome');
    });

    // Solicitud
    Route::resource('solicitud', 'SolicitudController');

    // Upload Solicitud
    Route::put('solicitud/solicitante/{solicitud}', 'SolicitudController@uploadSolicitud')->name('solicitud.upload.solicitante');
    Route::put('solicitud/tecnico/{solicitud}', 'SolicitudController@uploadTecnico')->name('solicitud.upload.tecnico');

    // Etapa Inicio
    Route::resource('etapa_inicio', 'EtapaInicioController');
    Route::get('etapa_inicio/{solicitud}/descargar_solicitante', 'EtapaInicioController@descargarSolicitante')->name('etapa_inicio.descargar_solicitante');
    Route::get('etapa_inicio/{solicitud}/descargar_tecnico', 'EtapaInicioController@descargarTecnico')->name('etapa_inicio.descargar_tecnico');
});
