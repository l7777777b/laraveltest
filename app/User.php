<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $fillable = ['nama', 'alamat'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	//protected $guarded = ['id'];
	public $incrementing = false;
}
