<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

//Facades
use Hash;

class User extends Model implements AuthenticatableContract {

	use Authenticatable, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'role'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'role', 'remember_token'];

	/**
	* The attributes that be mutated to dates
	*
	* @var string
	*/
	protected $dates = ['deleted_at'];

	/**
	* Set the hash for the password
	*
	* @param 	string $value
	* @return 	void
	*/
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = Hash::make($value);
	}

	/**
	* Remove white spaces adjacent for the name
	*
	* @param 	string $value
	* @return 	void
	*/
	public function setNameAttribute($value)
	{
		$name = trim($value);
		$name = preg_replace('/\s\s+/', ' ', $name);

		$this->attributes['name'] = $name;
	}

	/*
	 * Relación n:m teacher dictate course
	 */
	public function courses()
	{
		return $this->belongsToMany('App\Models\Course', 'teachers_dictate');
	}

	/*
	 * Relación n:m "enrolling to student in the course"
	 */
	public function enrolling()
	{
		return $this->belongsToMany('App\Models\Course', 'enrolling_to_students');
	}

	public function tests()
	{
		return $this->hasMany('App\Models\Test', 'student_performs');
	}
}
