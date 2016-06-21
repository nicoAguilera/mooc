<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

//Facades
use Lang;
use Redirect;
use View;

//Models
use App\Models\Course;
use App\Models\User;

class TeacherController extends Controller {

	public function __construct()
	{
		$this->middleware('is.admin', ['only' => ['create', 'store'] ]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($courseId)
	{
		$title = Lang::get('teachers.index_browser_title');

		$course = Course::findOrFail($courseId);
		$teachers = User::where('role', '=', 'teacher')->paginate(5);
		//$teachers = User::paginate(2);

		return View::make('teachers.index', [
			'title'		=>	$title,
			'course'	=>	$course,
			'teachers'	=> 	$teachers
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($courseId)
	{
		$course = Course::findOrFail($courseId);

		$title = Lang::get('teachers.create_browser_title');

		return View::make('teachers.create', ['title' => $title, 'course' => $course]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
		$user = User::create([
						'name'		=> $request['name'],
						'email'		=> $request['email'],
						'password'	=> $request['password'],
						'role'		=> 'teacher',
					]);


		if(isset($request['courseId']))
		{
			return Redirect::route('teachers.index', $request['courseId'])
							->with('alert.success', Lang::get('teachers.create_success_alert'));
		}
		else
		{
			//debería ser opcional el parametro de course id y vericarlo en el metodo index
			return Redirect::route('teachers.index')
							->with('alert.success', Lang::get('teachers.create_success_alert'));
		}

		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
