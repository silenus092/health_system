<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model {

	//
    public $timestamps = false;
	protected $table = 'persons';
	protected $primaryKey = "person_id";
		///public $timestamps = false;
}
