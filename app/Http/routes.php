<?php

Route::get('/', function () {
 return view('admin.login');
});


Route::group(['middleware' => 'auth'], function() {

	Route::get('blank', function () {
	 return view('admin.blank');
	});

	Route::get('usuario/data',['as'=>'usuariodata','uses'=>'UsuarioController@anyData']);
	Route::post('usuario/perfil', 'UsuarioController@editprofile');
	Route::get('usuario/perfil', 'UsuarioController@perfil');
	Route::post('usuario/image', 'UsuarioController@editimage');
	Route::get('usuario/modal/{modal}/{id?}', 'UsuarioController@modal');
	Route::get('usuario/getdata/{id?}', 'UsuarioController@dataUser');



	Route::group(['middleware' => 'role'], function() {

        Route::get('cliente/data',['as'=>'clientedata','uses'=>'ClienteController@anyDataCliente']);
        Route::get('cliente/modal/{modal}/{id?}', 'ClienteController@modal');
        Route::get('cliente/getdata/{id?}', 'ClienteController@dataCliente');
        Route::get('cliente/getcliente/{field}/{value}', 'ClienteController@getCliente');
        Route::resource('cliente', 'ClienteController');

		Route::resource('usuario', 'UsuarioController');

	});
    Route::get('incidencia/getdata/{id?}', 'IncidenciaController@dataIncidencia');
    Route::get('incidencia/modal/{modal}/{id?}', 'IncidenciaController@modal');
    Route::get('incidencia/data',['as'=>'incidenciadata','uses'=>'IncidenciaController@anyData']);
    Route::get('incidencia/asignada',['as'=>'incidenciaasignada','uses'=>'IncidenciaController@incidenciasAsignadas']);
    Route::resource('incidencia', 'IncidenciaController');
    Route::get('estado/getdata','EstadoController@getEstados');

});

// Authentication routes...
Route::get('login',['uses'=>'Auth\AuthController@getLogin','as'=>'login'] );
Route::post('login', ['uses'=>'Auth\AuthController@postLogin','as'=>'login']);
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');