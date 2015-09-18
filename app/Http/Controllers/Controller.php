<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB ;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	 function check_my_relationship($that_relationship){
		 $relationship_id = 8 ;
			if($that_relationship == 'พ่อเเม่'){
					$relationship_id = DB::table('relationship_type')->select('relationship_type_id')->where('relationship_type_description', '=', "ลูก")->first();
			}else if($that_relationship == 'น้องชาย' ||  $that_relationship == 'น้องสาว' || $that_relationship == 'พี่ชาย' || $that_relationship == 'พี่สาว' ){
					$relationship_id = DB::table('relationship_type')->select('relationship_type_id')->where('relationship_type_description', '=', "พี่น้อง")->first();
			}else if($that_relationship == 'สามี' || $that_relationship == 'ภรรยา'){
					$relationship_id = DB::table('relationship_type')->select('relationship_type_id')->where('relationship_type_description', '=', "คู่สมรส")->first();
			}else {
					$relationship_id = DB::table('relationship_type')->select('relationship_type_id')->where('relationship_type_description', '=', "ญาติ")->first();
			}
			return $relationship_id->relationship_type_id;
	}

	 function check_role($role){
		 $role_id = DB::table('roles')->select('role_id')->where('role_description', '=', $role)->first();
		return  $role_id->role_id;
	}
 /*
	function check_my_relationship($relationship){
		$my_relationship_id = NULL ;
		 if($that_relationship == 'พ่อ' || $that_relationship == 'เเม่'){

		 }else{

		 }
		 return $my_relationship_id;
	}*/

	function check_my_role($that_role , $person_id){
		$my_role_id = 21;
		$person = DB::table('persons')->where('person_id', '=', $person_id)->first();
		if($that_role == "พ่อ" || $that_role == "เเม่" ){
				if($person->person_sex == "male"){
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "ลูกชาย")->first();
				}else{
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "ลูกสาว")->first();
				}
		}else if($that_role == "พี่ชาย" || $that_role == "พี่สาว" ){
				if($person->person_sex == "male"){
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "น้องชาย")->first();
				}else{
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "น้องสาว")->first();
				}
		}else if($that_role == "น้องชาย" || $that_role == "น้องสาว" ){
				if($person->person_sex == "male"){
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "พี่ชาย")->first();
				}else{
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "พี่สาว")->first();
				}
		}else if($that_role == "ปู่" || $that_role == "ตา" || $that_role =="ย่า" || $that_role == "ยาย" ){
				if($person->person_sex == "male"){
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "หลานชาย")->first();
				}else{
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "หลานสาว")->first();
				}
		}else if($that_role == "ปู่ทวด" || $that_role == "ตาทวด" || $that_role =="ย่าทวด" || $that_role == "ยายทวด" ){
				if($person->person_sex == "male"){
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "เหลนชาย")->first();
				}else{
					$my_role_id = DB::table('roles')->select('role_id')->where('role_description', '=', "เหลนสาว")->first();
				}
		}
		if(count($my_role_id) != 0){
			return $my_role_id->role_id;
		}else {
			return $my_role_id;
		}
	 	// this function   is not finish yet!!
	}


}
