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

    // Llenar Solicitud
    Route::get('solicitud/{solicitud}/solicitar', 'SolicitudController@llenarSolicitud')->name('solicitud.solicitar');

    // Revisar Solicitud
    Route::get('solicitud/{solicitud}/revisar', 'SolicitudController@revisarSolicitud')->name('solicitud.revisar');

    // Download Documento Digital
    Route::get('solicitud/{solicitud}/descargar/{documentoDigital}', 'SolicitudController@descargarDocumento')->name('solicitud.descargar');

    // Upload Solicitud
    Route::put('solicitud/{solicitud}/solicitar/{documentoDigital}', 'SolicitudController@subirSolicitud')->name('solicitud.subir_solicitud');

    // Editar fojas de Solicitud
    Route::get('solicitud/{solicitud}/documento/{documentoDigital}', 'SolicitudController@getSolicitudDocumento')->name('solicitud.get_solicitud_documento');
    Route::put('solicitud/{solicitud}/editar/{documentoDigital}', 'SolicitudController@editarSolicitudDocumento')->name('solicitud.editar_solicitud_documento');
    Route::delete('solicitud/{solicitud}/eliminar/{documentoDigital}', 'SolicitudController@eliminarSolicitudDocumento')->name('solicitud.eliminar_solicitud_documento');

    // Revisión Solicitud
    Route::post('solicitud/{solicitud}/revision', 'SolicitudController@revisionSolicitud')->name('solicitud.revision');

    // Etapa Inicio
    Route::resource('etapa_inicio', 'EtapaInicioController');
    Route::get('etapa_inicio/{solicitud}/descargar_solicitante', 'EtapaInicioController@descargarSolicitante')->name('etapa_inicio.descargar_solicitante');
    Route::get('etapa_inicio/{solicitud}/descargar_tecnico', 'EtapaInicioController@descargarTecnico')->name('etapa_inicio.descargar_tecnico');

    // PDF Registro
    Route::get('pdf/registro/{codigoEtapaInicio}', 'PdfController@registro')->name('pdf.registro');
});
