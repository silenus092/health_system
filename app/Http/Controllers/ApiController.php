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
			// Let's fill personal information to id array list.
			
			
			
			
			$depth = 3 ;
			while(count($this->list) >0 && $depth > 0 ){
				//echo "Start " .var_dump($this->list);
				$size = count($this->list);
				for( $i=0 ; $i < $size ; $i++){
					if(isset($this->list[$i])){
						$r = DB::table('persons')->where('person_id', '=', $this->list[$i])->first();
						if(!$this->check_key_has_exists_value($result,'id',$r->person_id )&& in_array($r->person_id, $this->list)){
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
							// store it into array
							$result['person'][] = $person_array;
							// finish this person , remove it so we will not serach for this person again

							//$this->list[$i] = null;
							
						}else{
							 
						}
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
	
	
	
	public function find_relatives(){
		
	}
	public function find_parent($result,$r){
		
		
		$relation_parent_array = array();
		$relation_parent = DB::table('relationship')
			->where('person_1_id', '=', $r->person_id)
			->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
			->where('relationship_type_description', '=', "พ่อเเม่")
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
					if(!$this->check_key_has_exists_value($result,'id',$person_dad->person_id)&&!in_array($person_dad->person_id, $this->list)){
						$this->list[]  = $person_dad->person_id ; // add dad to list
					}
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
					if(!$this->check_key_has_exists_value($result,'id',$person_mom->person_id )&&!in_array($person_mom->person_id, $this->list)){
						$this->list[] = $person_mom->person_id ; // add mom to list
					}
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

			if(!$this->check_key_has_exists_value($result,'id',$person_2->person_id) && !in_array($person_2->person_id, $this->list)){
				$this->list[]  =   $person_2->person_id;
			}
	
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
	public function add_person(){

		try {
			if ($request->ajax()) {
				DB::beginTransaction();
				$person_sex = Input::get('sex');
				$Person_id = DB::table('persons')->insertGetId(['person_first_name' => Input::get('first_name'), 					 'person_last_name' => Input::get('last_name'),
																'person_sex' => $person_sex ]);
				$parents = Input::get('parents_id');
				$spouses = Input::get('spouses_id');
				$relatives = Input::get('relatives_id');
				$sons = Input::get('sons_id');
				$type_of_relationship  = Input::get('type_of_relationship');
				/*if(){

				}else if(){

				}else if(){

				}else if(){

				}else{

				}*/
				// find parent
				/*foreach($parents as $parent){
					$this->find_parent($parent);
				}
				   //  find spouse
				foreach($spouses as ){

				}
				 // find relative
				foreach(){

				}*/

			}
		}catch (Exception $e) {
			DB::rollback();
			$result['status'] = 2;
			$result['message'] = $e->getMessage();
			return response()->json($result, 200); 
		}
	}

	public function edit_person(){

	}
	public function delete_person(){

	}
}
?>
