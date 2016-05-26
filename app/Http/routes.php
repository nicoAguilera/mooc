<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

/*
|---------------------------------------------------------------------------
|Rutas adiconales
|---------------------------------------------------------------------------
*/
Route::post('cursos/guardar', 'CourseController@saveChanges');

Route::get('cursos/{id}/contenido', 'CourseController@showEditor');



/*
|----------------------------------------------------------------------------
|Rutas del controlador de profesores
|----------------------------------------------------------------------------
*/

Route::resource('profesores', 'TeacherController');

/*
|----------------------------------------------------------------------------
|Rutas del controlador de cursos
|----------------------------------------------------------------------------
*/

Route::resource('cursos', 'CourseController');

/*
|----------------------------------------------------------------------------
|Rutas del controlador de profesores
|----------------------------------------------------------------------------
*/

Route::resource('alumnos', 'StudentController');