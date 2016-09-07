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
	
	//Route::group(['middleware' => 'role'], function() {
		Route::resource('usuario', 'UsuarioController');
		Route::resource('incidencia', 'IncidenciaController');
	//});

});

// Authentication routes...
Route::get('login',['uses'=>'Auth\AuthController@getLogin','as'=>'login'] );
Route::post('login', ['uses'=>'Auth\AuthController@postLogin','as'=>'login']);
Route::get('logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');