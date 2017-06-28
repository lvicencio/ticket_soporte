<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Ruta para cargar el select
Route::get('/proyecto/{id}/niveles','Admin\LevelController@byProject');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
