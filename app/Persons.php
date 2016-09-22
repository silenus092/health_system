<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model {

	//
    public $timestamps = false;
    protected $fillable =  ['person_first_name', 'person_last_name' ,
        'person_age', 'person_sex',
        'person_citizenID',    'person_birth_date' ,
        'person_house_num' ,    'person_soi' ,
        'person_road',    'person_tumbon',
        'person_mooh_num',    'person_amphur' ,
        'person_province',    'person_post_code' ,
        'person_mobile_phone', 'person_phone','person_alive'
    ];
	protected $table = 'persons';
	protected $primaryKey = "person_id";
		///public $timestamps = false;
}
