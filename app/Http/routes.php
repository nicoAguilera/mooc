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

Route::get('/', ['uses' => 'WelcomeController@index', 'as' => 'welcome']);

Route::get('home', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function()
{
	//Login
	Route::get('login', ['uses' => 'AuthController@getLogin', 'as' => 'login']);
	Route::post('login', ['uses' => 'AuthController@postLogin', 'as' => 'login']);

	//Signup
	Route::get('signup', ['uses' => 'AuthController@getSignup', 'as' => 'signup']);
	Route::post('signup', ['uses' => 'AuthController@postSignup', 'as' => 'signup']);

	//Logout
	Route::get('logout', ['uses' => 'AuthController@getLogout', 'as' => 'logout']);
});

/*
|---------------------------------------------------------------------------
|Rutas del controlador de Administrador
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function()
{
	Route::get('/',[
		'uses'	=>	'AdminController@showPanelAdmin',
		'as'	=>	'admin.panel_admin'
	]);

	/* 
	|----------------------------------------------------------------------
	|COURSES 
	|----------------------------------------------------------------------
	*/

	Route::get('courses', [
		'uses'	=>	'AdminController@coursesIndex',
		'as'	=>	'admin.courses.index'
	]);

	Route::get('courses/create',[
		'uses'	=>	'AdminController@coursesCreate',
		'as'	=>	'courses.create'
	]);

	Route::post('courses', [
		'uses'	=>	'CourseController@store',
		'as'	=>	'courses.store'
	]);

	Route::get('courses/{id}', [
		'uses'	=>	'AdminController@coursesShow',
		'as'	=>	'admin.courses.show'
	]);

	Route::get('courses/{id}/edit', [
		'uses'	=>	'CourseController@edit',
		'as'	=>	'courses.edit'
	]);

	Route::patch('courses/{id}', [
		'uses'	=>	'CourseController@update',
		'as'	=>	'courses.update'
	]);

	Route::get('courses/{id}/teachers/add', [
		'uses'	=>	'AdminController@addTeachersCourse',
		'as'	=>	'courses.teachers.add'
	]);

	Route::get('courses/{id}/teachers/create', [
		'uses'	=>	'AdminController@teachersCreateAndAddCourse',
		'as'	=>	'courses.teachers.create'
	]);

	Route::get('courses/{courseId}/teachers/{teacherId}',[
		'uses'	=>	'AdminController@coursesTeachersShow',
		'as'	=>	'admin.courses.teachers.show'
	]);

	Route::get('courses/{courseId}/teachers/{teacherId}/dictate', [
		'uses'	=>	'AdminController@teacherDictateCourse',
		'as'	=>	'courses.teachers.dictate'
	]);

	Route::get('courses/{courseId}/teachers/{teacherId}/delete', [
		'uses'	=>	'AdminController@destroyTeacherDictateCourse',
		'as'	=>	'teachers.destroy'
	]);

	/* 
	|----------------------------------------------------------------------
	|TEACHERS
	|----------------------------------------------------------------------
	*/

	Route::get('teachers', [
		'uses'	=>	'AdminController@teachersIndex',
		'as'	=>	'admin.teachers.index'
	]);

	Route::get('teachers/create', [
		'uses'	=>	'AdminController@teachersCreate',
		'as'	=>	'teachers.create'
	]);

	Route::post('teachers', [
		'uses'	=>	'TeacherController@store',
		'as'	=>	'teachers.store'
	]);

	Route::get('teachers/{id}', [
		'uses'	=>	'AdminController@teachersShow',
		'as'	=>	'admin.teachers.show'
	]);
});

/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/


/*
|---------------------------------------------------------------------------
|Rutas del controlador de modulos
|---------------------------------------------------------------------------
*/

Route::get('courses/{id}', [
	'uses'	=>	'CourseController@show',
	'as'	=>	'courses.show'
]);

/*
|----------------------------------------------------------------------------
|Rutas del controlador de modulos
|----------------------------------------------------------------------------
*/

Route::get('courses/{courseId}/modules/{moduleId}', [
		'uses'	=>	'ModuleController@show',
		'as'	=>	'modules.show'
	]);

Route::get('courses/{courseId}/modules/{moduleId}/edit', [
		'uses'	=>	'ModuleController@edit',
		'as'	=>	'modules.edit'
	]);

Route::patch('courses/{courseId}/modules/{moduleId}', [
		'uses'	=>	'ModuleController@update',
		'as'	=>	'modules.update'
	]);

/*
|----------------------------------------------------------------------------
|Rutas del controlador de actividades
|----------------------------------------------------------------------------
*/



Route::get('courses/{courseId}/modules/{moduleId}/activities/{activityId}', [
		'uses'	=>	'ActivityController@show',
		'as'	=>	'activities.show'
	]);



/**
|----------------------------------------------------------------------------
|Refactorizar rutas de TeacherController con las respectivas de AdminController
| En vez de 4 metodos en Admin utilizo los 2 por defecto de Teacher (create y show)
| y analizo las opciones redirijiendo o mostrando según el lugar desde donde se
| invoca
|----------------------------------------------------------------------------
*/

/*
|----------------------------------------------------------------------------
|Rutas del controlador de Profesores
|----------------------------------------------------------------------------
*/

Route::group(['prefix' => 'teachers'], function(){
	Route::get('/{teacherId}', [
		'uses'	=>	'TeacherController@show',
		'as'	=>	'teachers.show'
	]);

	/* 
	|----------------------------------------------------------------------
	|COURSES
	|----------------------------------------------------------------------
	*/

	Route::get('/{teacherId}/courses', [
		'uses'	=>	'TeacherController@indexCourses',
		'as'	=>	'teachers.courses.index'
	]);

	Route::get('/{teacherId}/courses/{courseId}', [
		'uses'	=>	'TeacherController@showCourses',
		'as'	=>	'teachers.courses.show'
	]);

	// No cumple con el formato de ruta de restful
	Route::patch('courses/publish', [
		'uses'	=>	'CourseController@publishingCourse',
		'as'	=>	'courses.publish'
	]);

	/* 
	|----------------------------------------------------------------------
	|MODULES
	|----------------------------------------------------------------------
	*/

	Route::get('/{teacherId}/courses/{courseId}/modules/create', [
		'uses'	=>	'ModuleController@create',
		'as'	=>	'modules.create'
	]);

	Route::post('{teacherId}/courses/{courseId}/modules', [
		'uses'	=>	'ModuleController@store',
		'as'	=>	'modules.store'
	]);

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}', [
		'uses'	=>	'TeacherController@showModules',
		'as'	=>	'teachers.courses.modules.show'
	]);

	/* 
	|----------------------------------------------------------------------
	|ACTIVITIES
	|----------------------------------------------------------------------
	*/

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/activities/create', [
		'uses'	=>	'ActivityController@create',
		'as'	=>	'activities.create'
	]);

	Route::post('{teacherId}/courses/{courseId}/modules/{moduleId}/activities', [
		'uses'	=>	'ActivityController@store',
		'as'	=>	'activities.store'
	]);

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/activities/{activityId}', [
		'uses'	=>	'TeacherController@showActivities',
		'as'	=>	'teachers.courses.modules.activities.show'
	]);

	Route::get('courses/{courseId}/modules/{moduleId}/activities/{activityId}/edit',[
		'uses'	=>	'ActivityController@edit',
		'as'	=>	'activities.edit'
	]);

	Route::patch('courses/{courseId}/modules/{moduleId}/activities/{activityId}',[
		'uses'	=>	'ActivityController@update',
		'as'	=>	'activities.update'
	]);

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/activities/{activityId}/editContent', [
		'uses'	=>	'ActivityController@showEditor',
		'as'	=>	'activities.edit.content'
	]);

	Route::post('activities/{id}/saveContent', [
		'uses'	=>	'ActivityController@saveChanges',
		'as'	=>	'activities.save.content'
	]);

	/* 
	|----------------------------------------------------------------------
	|TESTS
	|----------------------------------------------------------------------
	*/

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/create', [
		'uses'	=>	'TeacherController@createTests',
		'as'	=>	'tests.create'
	]);

	Route::post('{teacherId}/courses/{courseId}/modules/{moduleId}/tests', [
		'uses'	=>	'TeacherController@storeTests',
		'as'	=>	'tests.store'
	]);

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}', [
		'uses'	=>	'TeacherController@showTests',
		'as'	=>	'tests.show'
	]);

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/edit', [
		'uses'	=>	'TeacherController@editTests',
		'as'	=>	'tests.edit'
	]);

	/* 
	|----------------------------------------------------------------------
	|QUESTIONS
	|----------------------------------------------------------------------
	*/

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}/questions/create', [
		'uses'	=>	'TeacherController@createQuestions',
		'as'	=>	'questions.create'
	]);

	Route::post('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}/questions', [
		'uses'	=>	'TeacherController@storeQuestions',
		'as'	=>	'questions.store'
	]);

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}/questions/{questionId}', [
		'uses'	=>	'TeacherController@showQuestions',
		'as'	=>	'questions.show'
	]);

	/* 
	|----------------------------------------------------------------------
	|OPTIONS
	|----------------------------------------------------------------------
	*/

	Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}/questions/{questionId}/options/create', [
		'uses'	=>	'TeacherController@createOptions',
		'as'	=>	'options.create'
	]);

	Route::post('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}/questions/{questionId}/options', [
		'uses'	=>	'TeacherController@storeOptions',
		'as'	=>	'options.store'
	]);

	/*Route::get('{teacherId}/courses/{courseId}/modules/{moduleId}/tests/{testId}/questions/{questionId}/options/{optionId}', [
		'uses'	=>	'TeacherController@showOptions',
		'as'	=>	'options.show'
	]);*/
});

/*Route::get('courses/{id}/teachers/create', [
		'uses'	=>	'TeacherController@create',
		'as'	=>	'teachers.create'
	]);



Route::get('courses/{courseId}/teachers/{teacherId}',[
		'uses'	=>	'TeacherController@show',
		'as'	=>	'teachers.show'
	]);*/


/*
|----------------------------------------------------------------------------
|Rutas del controlador de alumnos
|----------------------------------------------------------------------------
*/
Route::group(['prefix' => 'students'], function(){

	Route::get('{studentId}/courses/{courseId}', [
		'uses'	=>	'StudentController@coursesShow',
		'as'	=>	'students.courses.show'
	]);

	Route::get('{studentId}/courses/{courseId}/enrolling', [
		'uses'	=>	'StudentController@enrolling',
		'as'	=>	'students.enrolling'
	]);

	Route::get('{studentId}/courses/{courseId}/unsubscribe', [
		'uses'	=>	'StudentController@unsubscribe',
		'as'	=>	'students.unsubscribe'
	]);

	Route::get('{id}/history', [
		'uses'	=>	'StudentController@history',
		'as'	=>	'students.history'
	]);

	Route::get('{studentId}/courses/{courseId}/modules/{moduleId}', [
		'uses'	=>	'StudentController@showModules',
		'as'	=>	'students.modules.show'
	]);

	Route::get('{studentId}/courses/{courseId}/modules/{moduleId}/activities/{activityId}', [
		'uses'	=>	'StudentController@showActivities',
		'as'	=>	'students.activities.show'
	]);
});

Route::resource('students', 'StudentController');
