<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use DB ;
use Input;

class ApiController extends Controller
{
	/**
    * Display the specified resource.
    *
    * @param int $id
    *
    * @return Response
    */
	private $list =  array();

	public function show_tree($id)
	{
		try{
			// check this guy exist or not
			$result = array();
			$r =DB::table('persons')->where('person_citizenID', '=', $id)->first();
			if ( count($r) == 0 )
			{

				$result['Info']['status'] = "Complete";
				$result['Info']['message'] = "No Person Found";

				return response()->json($result, 200);
			}
			$result['Info']['status'] = "Complete";
			$result['Info']['message'] = "Found";
			// Fuck , this array  for persons
			$person_array =array();

			// Init for patient only
			$person_array['id']  = $r->person_id;
			$person_array['title'] = $r->person_first_name." ".$r->person_last_name;
			$person_array['description'] = "Sex: ".$r->person_sex." Age: ".$r->person_age;
			/* $result['description']['sex']  = $r->person_sex;
            $result['description']['birth_date']  = $r->person_birth_date;
            $result['description']['age']  = $r->person_age;
            $result['description']['citizen_id']  = $r->person_citizenID;
            $result['description']['house_num']  = $r->person_house_num;
            $result['description']['mooh_num']  = $r->person_mooh_num;
            $result['description']['soi']  = $r->person_soi;
            $result['description']['road']  = $r->person_road;
            $result['description']['tumbon']  = $r->person_tumbon;
            $result['description']['amphur']  = $r->person_amphur;
            $result['description']['province']  = $r->person_province;
            $result['description']['post_code']  = $r->person_post_code;
            $result['description']['phone']  = $r->person_phone;
            $result['description']['mobile_phone']  = $r->person_mobile_phone;*/
			//$person_array['image']  = null ;
			$pink = $this->check_female($r->person_sex);
			if($pink != null){
				$person_array['itemTitleColor']  = $pink;
			}
			//
			//	เดี่ยวต้อง เช็ค ว่าเป็นผู้ป่วยรึเปล่า
			//
			$person_array['groupTitle'] ="ผู้ป่วย";
			$person_array['groupTitleColor'] ="orange";

			$parents = $this->find_parent($result,$r);
			if($parents != null){
				$person_array['parents']  = $parents;
			}
			$spouses  = $this->find_spouse($result,$r);
			if($spouses != null){
				$person_array['spouses'][] = $spouses;
			}
			$result['person'][] = $person_array;
			// หาพี่น้องตัวเองด้วย
			$this->find_relatives($result,$r);

			// Let's fill personal information to id array list.
			$depth = 2 ;
			while(count($this->list) >0 && $depth > 0 ){

				$size = count($this->list);
				for( $i=0 ; $i < $size ; $i++){
					if(isset($this->list[$i]) && !$this->check_key_has_exists_value($result,'id',$this->list[$i]) ){
						$r = DB::table('persons')->where('person_id', '=', $this->list[$i])->first();

						$person_array =array();
						$person_array  = $this->set_personal_info($person_array , $r);

						// Find his/her parent
						$parents = $this->find_parent($result,$r);
						if($parents != null){
							$person_array['parents']  = $parents;
						}

						// Find his/her spouse
						$spouses  = $this->find_spouse($result,$r);
						if($spouses != null){
							$person_array['spouses'][] = $spouses;
						}

						$this->find_relatives($result,$r);
						// store it into array
						$result['person'][] = $person_array;
						// finish this person , remove it so we will not serach for this person again

						//$this->list[$i] = null;

						$this->list[$i] = null;
					}

				}

				$depth--;
			}
			return response()->json($result, 200);
		}catch(Exception $e) {
			$result['status'] = "Error";
			$result['message'] = $e;
			return response()->json($result, 200);
		}
	}

	public function check_female($sex){
		if($sex== "female"){
			return "pink";
		}else{
			return null;
		}

	}



	public function find_relatives($result,$r){
		$relation_relatives_array = array();
		$relation_relatives = DB::table('relationship')
			->where('person_1_id', '=', $r->person_id)
			->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
			->where('relationship_type_description', '=', "พี่น้อง")
			->get();
		if(count($relation_relatives) != 0 ){
			foreach ($relation_relatives as $rr) {
				$person_2 = DB::table('persons')
					->where('person_id', '=', $rr->person_2_id)
					->first();
				if(!$this->check_key_has_exists_value($result,'id',$person_2->person_id) && !in_array($person_2->person_id, $this->list)){
					$this->list[]  =   $person_2->person_id;
				}
			}
			return  $person_2->person_id;
		}else{
			return null;
		}
	}

	public function find_parent($result,$r){
		$relation_parent_array = array();
		$relation_parent = DB::table('relationship')
			->where('person_1_id', '=', $r->person_id)
			->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
			->where('relationship_type_description', '=', "พ่อเเม่ลูก")
			->get();
		if(count($relation_parent) != 0 ){

			//$rp_array =array();
			// find  dad
			foreach ($relation_parent as $rp) {
				$role_dad= DB::table('roles')->where('role_id', '=', $rp->role_2_id)
					->where('role_description', '=', "พ่อ")
					->first();
				if(count($role_dad) != 0){
					$person_dad = DB::table('persons')
						->where('person_id', '=', $rp->person_2_id)
						->first();
					//$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;

					$this->list[]  = $person_dad->person_id ; // add dad to list

					$relation_parent_array[]= $person_dad->person_id;
					//$rp_array['role']=$role_dad->role_description;
				}

				// find mom
				$role_mom= DB::table('roles')->where('role_id', '=', $rp->role_2_id)
					->where('role_description', '=', "เเม่")
					->first();
				if(count($role_mom) != 0){
					$person_mom = DB::table('persons')
						->where('person_id', '=', $rp->person_2_id)
						->first();
					//$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;

					$this->list[] = $person_mom->person_id ; // add mom to list

					$relation_parent_array[]= $person_mom->person_id;
					//$rp_array['role']=$role_mom->role_description;

				}
				//array_push($relation_parent_array, $rp_array);
			}

			return  $relation_parent_array;
		}else{
			return null;
		}
	}

	public function find_spouse($result,$r){
		//find_married

		$relation_married = DB::table('relationship')
			->where('person_1_id', '=', $r->person_id)
			->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
			->where('relationship_type_description', '=', "คู่สมรส")
			->first();
		if(count($relation_married) != 0 ){
			//$role= DB::table('roles')->where('role_id', '=', $relation_married->role_2_id)->first();
			$person_2 = DB::table('persons')
				->where('person_id', '=', $relation_married->person_2_id)
				->first();


			$this->list[]  =   $person_2->person_id;


			return  $person_2->person_id;

		}else{
			return null;
		}
	}

	public function set_personal_info($person_array , $r)
	{
		$person_array['id']  = $r->person_id;
		$person_array['title'] = $r->person_first_name." ".$r->person_last_name;
		$person_array['description'] = "Sex: ".$r->person_sex." Age: ".$r->person_age;
		//$person_array['image']  = null ;
		//$person_array['itemTitleColor']  = $this->check_female($r->person_sex);
		$pink = $this->check_female($r->person_sex);
		if($pink != null){
			$person_array['itemTitleColor']  = $pink;
		}
		if ( count(DB::table('patients')->where('person_id', '=',$r->person_id)->first()) > 0 ){
			$person_array['groupTitle'] ="ผู้ป่วย";
			$person_array['groupTitleColor'] ="orange";
		}else{
			/*$person_array['groupTitle'] =null;
            $person_array['groupTitleColor'] =null;*/
		}

		return $person_array;
	}
	/**
	* Add new person
	*/
	
	public function add_person(){
		try {
			if ($request->ajax()) {
				DB::beginTransaction();
				$person_sex = Input::get('sex');
				$person_age = Input::get('age');
				$Person_id = DB::table('persons')->insertGetId(['person_first_name' => Input::get('first_name'), 					 'person_last_name' => Input::get('last_name'),
					'person_sex' => $person_sex , 'person_age' => $person_sex ]);
				$parents = Input::get('parents_id');
				$spouses = Input::get('spouses_id');
				$relatives = Input::get('relatives_id');
				$sons = Input::get('sons_id');

				$type_of_relationship  = Input::get('type_of_relationship');
				if($type_of_relationship  == "พ่อเเม่"){
					$this->add_spouse($Person_id ,$spouses,	$person_sex);
					$this->add_child($Person_id,$sons,$person_sex);
				}else if($type_of_relationship == "สามีภรรยา"){
					$this->add_spouse(	$Person_id ,$spouses,	$person_sex);
				}else if($type_of_relationship == "พี่น้อง"){
					$this->add_relative($Person_id ,$relatives ,$person_sex,$person_age);
					$this->add_parent($Person_id ,$parents ,$person_sex);
				}else if($type_of_relationship == "ลูก"){
					$this->add_parent($Person_id ,$parents ,$person_sex);
					$this->add_relative($Person_id ,$relatives ,$person_sex,$person_age);
				}else{
					$result['status'] = "No relationship found ";
					$result['message'] = "please select relationship before submit.";
					return response()->json($result, 200);
				}

				// update relationship with other persons

				
				
				
				
				
				DB::commit();
				$result['status'] = "Success";
				$result['message'] = "";
				return response()->json($result, 200);
			}else {
				$result['status'] = "Not Ajax requests";
				$result['message'] = "please contact admin, thank yous";
				return response()->json($result, 200);
			}
		}catch (Exception $e) {
			DB::rollback();
			$result['status'] = "Error";
			$result['message'] = $e->getMessage();
			return response()->json($result, 200);
		}
	}
	// กรณีที่ตัวเองเป็นลูก
	public function add_child($my_id ,$parnets ,$my_sex){
		$role1 = 21;
		$role2 = 21;
		if($my_sex==male){
			$role1 = 19;
		}else if($my_sex == female){
			$role1 = 20;
		}else{
			$role1 = 21;
		}
		foreach ($parnets as $parent_id) {
			$parent_obj = DB::table('persons')->where('person_id', '=',$childen_id)->first();
			if($parent_obj->person_sex==male){
				$role2 = 1;
			}else if($parent_obj->person_sex == female){
				$role2 = 2;
			}else{
				$role2 = 21;
			}
			$relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
				'relationship_type_id' => 3 ,'person_2_id' => $parent_obj->person_id, 'role_2_id' => $role2 ]);
		}

	}
	// กรณีที่ตัวเองเป็นพ่อหรือเเม่
	public function add_parent($my_id ,$parents ,$my_sex){
		$role1 = 21;
		$role2 = 21;
		if($my_sex==male){
			$role1 = 1;

		}else if($my_sex == female){
			$role1 = 2;

		}else{
			$role1 = 21;

		}
		foreach ($parents as $parent_id) {
			$parent_obj = DB::table('persons')->where('person_id', '=',$parent_id)->first();
			if($parent_obj->person_sex==male){
				$role2 = 1;
			}else if($parent_obj->person_sex == female){
				$role2 = 2;
			}else{
				$role2 = 21;
			}
			$relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
															   'relationship_type_id' => 3 ,'person_2_id' => $childen_id, 'role_2_id' => $role2 ]);
		}

	}
	//กรณีที่ตัวเองเป็นสามี หรือ ภรรยา
	public function add_spouse($my_id ,$spouse_id ,$my_sex){
		$role1 = 21;
		$role2 = 21;
		if($my_sex==male){
			$role1 = 23;
			$role2 = 22;
		}else if($my_sex == female){
			$role1 = 22;
			$role2 = 23;
		}else{
			$role1 = 21;
			$role2 = 21;
		}
		$relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
														   'relationship_type_id' => 4 ,'person_2_id' => $spouse_id, 'role_2_id' => $role2 ]);
	}

	public function add_relative($my_id ,$relatives ,$my_sex,$my_age){
		$role1 = 21;
		$role2 = 21;

		foreach ($relatives as $relatives_id) {
			$relative = DB::table('persons')->where('person_id', '=',$parent_id)->first();
			if($my_age > $relative->person_age){
				if($my_sex==male){
					$role1 = 3;

				}else if($my_sex == female){
					$role1 = 4;

				}else{
					$role1 = 21;

				}
				if($parent_obj->person_sex==male){
					$role2 = 5;
				}else if($parent_obj->person_sex == female){
					$role2 = 6;
				}else{
					$role2 = 21;
				}
			}else{ // If they have the same age , fall in this case too
				if($my_sex==male){
					$role1 = 5;

				}else if($my_sex == female){
					$role1 = 6;

				}else{
					$role1 = 21;

				}
				if($parent_obj->person_sex==male){
					$role2 = 3;
				}else if($parent_obj->person_sex == female){
					$role2 = 4;
				}else{
					$role2 = 21;
				}
			}
			$relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
															   'relationship_type_id' => 2 ,'person_2_id' => $childen_id, 'role_2_id' => $role2 ]);
		}
	}

	public function update_relationship_with_other(){

		// update ญาติที่อยู่ฝั่งพ่อ
		
		$parent_obj = DB::table('persons')->where('person_', '=',$childen_id)->first();
		// update ญาติที่อยู่ฝั่งเเม่
		
		// update ญาติที่อยู่ฝั่งสามี
		
		// update ญาติที่อยู่ฝั่งภรรยา
		
		// update หลาน
		
		// update ลูก
		
	}
	
	public function edit_person(){

	}
	public function delete_person(){

	}
}
?>
