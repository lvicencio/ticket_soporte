<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');

Route::get('/reportar', 'IncidentController@create');
Route::post('/reportar', 'IncidentController@store');

Route::get('/ver/{id}', 'IncidentController@show');
Route::get('/ver', 'IncidentController@todos');
Route::get('/ver/{name}','IncidentController@todos');
Route::get('incidencia/{id}/editar', 'IncidentController@editar');
Route::post('incidencia/{id}/editar', 'IncidentController@update');

Route::get('incidencia/{id}/atender', 'IncidentController@atender');
Route::get('incidencia/{id}/resolver', 'IncidentController@resolver');
Route::get('incidencia/{id}/abrir', 'IncidentController@abrir');
//Route::get('incidencia/{id}/editar', 'IncidentController@editar');
Route::get('incidencia/{id}/derivar', 'IncidentController@derivar');

//mensagges
Route::post('/mensajes', 'MessageController@store');

Route::group(['middleware'=>'admin','namespace'=>'Admin'], function(){
//usuarios
  Route::get('/usuarios', 'UserController@index');
  Route::post('/usuarios', 'UserController@store');
  Route::get('/usuario/{id}', 'UserController@edit');
  Route::post('/usuario/{id}', 'UserController@update');
  Route::get('/usuario/{id}/eliminar', 'UserController@delete');
  Route::get('/configusuarios','UserController@buscador');
  Route::get('/configusuarios/{name}','UserController@buscador');

//proyectos
  Route::get('/proyectos', 'ProjectController@index');
  Route::post('/proyectos', 'ProjectController@store');

  Route::get('/proyecto/{id}', 'ProjectController@edit');
  Route::post('/proyecto/{id}', 'ProjectController@update');
  Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete');
  Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore');
//Category
  Route::post('/categorias', 'CategoryController@store');
  Route::post('/categoria/editar', 'CategoryController@update');
  Route::get('/categoria/{id}/eliminar', 'CategoryController@delete');
  //Level
    Route::post('/niveles', 'LevelController@store');
    Route::post('/nivel/editar', 'LevelController@update');
    Route::get('/nivel/{id}/eliminar', 'LevelController@delete');
//proyect_user
  Route::post('/proyecto-usuario','ProyectUserController@store');
  Route::get('/proyecto-usuario/{id}/eliminar','ProyectUserController@delete');

  Route::get('/config', 'ConfigController@index');
});
