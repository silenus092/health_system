<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model {

	//
    public $timestamps = false;
    protected $table = 'relationship';
    protected $primaryKey = "relationship_id";

}
