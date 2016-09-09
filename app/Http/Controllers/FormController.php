<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use DB ;
use Input;

class FormController extends Controller
{
    /**
    * Create a new controller instance.
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        //
        return view('form_view');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(Request $request)
    {
        try {

            if ($request->ajax()) {
                DB::beginTransaction();
                    if($request->request_types == "dmd"){
                        // keep the personal  patient records
                        $Person_id = DB::table('persons')->insertGetId(
                        ['person_first_name' => Input::get('first_name'), 'person_last_name' => Input::get('last_name'),
                        'person_age' => Input::get('age'), 'person_sex' => Input::get('sex'),
                        'person_citizenID' => Input::get('citizen_id'),    'person_birth_date' => Input::get('birth_date'),
                        'person_house_num' => Input::get('ban_number'),    'person_soi' => Input::get('soi'),
                        'person_road' => Input::get('road'),    'person_tumbon' => Input::get('sub_district'),
                        'person_mooh_num' => Input::get('mooh_number'),    'person_amphur' => Input::get('district'),
                        'person_province' => Input::get('province'),    'person_post_code' => Input::get('postal_code'),
                        'person_mobile_phone' => Input::get('mobi_phone_number'), 'person_phone' => Input::get('house_number'),'person_alive'=> '1'
                        ]);
                        // keep the doctor profile
                        $Doctor_id = DB::table('doctors')->insertGetId(
                        ['doctor_name' => Input::get('doctor_name'), 'doctor_mobile_phone' => Input::get('doctor_mobilephonenumber'),
                        'doctor_phone' => Input::get('doctor_phonenumber'), 'hospital' => Input::get('hospital_name'), 'doctor_care_date' => Input::get('doctor_care_date') ,
                        'email' => Input::get('doctor_email')
                        ]);
                        // keep the patient profile
                        $Patient_id = DB::table('patients')->insertGetId(
                        ['doctor_id' => $Doctor_id, 'person_id' => $Person_id,
                        'registration_date' => date('Y-m-d')
                        ]);
                          //In future, if our system support many disease types , we need to change where on disease_type_name_en to id
                        $disease_types = DB::table('disease_types')->where('disease_type_name_en', 'Duchenne muscular dystrophy, DMD')->first();
                         // register disease type with question table
                        $disease_form_id = DB::table('disease_forms')->insertGetId(
                        ['disease_type_id' => $disease_types->disease_type_id] );

                        DB::table('patients_disease_forms')->insert(
                        ['patient_id' => $Patient_id, 'question_id' =>  $disease_form_id,
                        'registration_date' => date('Y-m-d')
                        ]);
                        // insert information record
                        $symptom_checkbox_10 = Input::get('10_symptom_checkbox');
                        DB::table('disease_1')->insert(
                        ['symptom_1_1' => Input::get('1_1_symptom'), 'symptom_1_2' =>  Input::get('1_2_symptom'),
                        'symptom_1_3' => Input::get('1_3_symptom'), 'symptom_2' =>  Input::get('2_symptom_age'),
                        'symptom_3' => Input::get('3_symptom_age'), 'symptom_4_1' =>  Input::get('4_1_symptom'),
                        'symptom_4_2' => Input::get('4_2_symptom'), 'symptom_4_3' => Input::get('4_2_symptom'),
                        'symptom_4_4' => Input::get('4_4_symptom'), 'symptom_5' =>   Input::get('5_symptom'),
                        'symptom_5_date' => Input::get('5_2_symptom_add_on_result_date'), 'symptom_5_result' =>  Input::get('5_2_symptom_add_on_result'),
                        'symptom_6' => Input::get('6_symptom'), 'symptom_6_date' => Input::get('6_2_symptom_add_on_result_date'),
                        'symptom_6_result' => Input::get('6_2_symptom_add_on_result'), 'symptom_7_1' =>  Input::get('7_1_symptom'),
                        'symptom_7_1_result' => Input::get('7_1_symptom_result'), 'symptom_7_2' =>Input::get('7_2_symptom'),
                        'symptom_7_2_result' => Input::get('7_2_symptom_result'), 'symptom_7_3' =>  Input::get('7_3_symptom'),
                        'symptom_7_3_result' => Input::get('7_3_symptom_result'), 'symptom_8' => Input::get('8_1_symptom'),
                        'symptom_9_male' => Input::get('9_male_number'), 'symptom_9_female' =>Input::get('9_female_number'),
                        'symptom_10_2_male' => Input::get('10_2_male_number'), 'symptom_10_2_female' =>Input::get('10_2_female_number'),
                        'symptom_10_1' => Input::get('10_symptom') , 'symptom_10_1_number' => Input::get('10_symptom_number'),'symptom_10_1_check' => $symptom_checkbox_10 ,
                        'questions_id' => $disease_form_id
                        ]);
                        $sym_10_name = json_decode(stripslashes(Input::get('vpb_item_name')));
                        $sym_10_age = json_decode(stripslashes(Input::get('vpb_item_ages')));
                        $sym_10_citizen_number = json_decode(stripslashes(Input::get('vpb_item_ids')));
                        $sym_10_roles =json_decode(stripslashes(Input::get('vpb_item_roles')));

                        if($symptom_checkbox_10 != "ไม่รู้") {
                            for($i = 0 ; $i < sizeof($sym_10_name) ; $i++){
                                if($sym_10_name[$i] != ' '   && $sym_10_name[$i] != null) {

                                    $name = explode(" ", $sym_10_name[$i]);
                                    $relative_person_id = DB::table('persons')->insertGetId(
                                        ['person_first_name' => $name[0], 'person_last_name' => $name[1],
                                            'person_age' => $sym_10_age[$i], 'person_citizenID' => $sym_10_citizen_number[$i],
                                            'person_sex' => 'male'
                                        ]);

                                    DB::table('relationship')->insert(
                                        ['person_1_id' => $Person_id, 'person_2_id' => $relative_person_id,
                                            'role_1_id' => $this->check_my_role($sym_10_roles[$i], $Person_id),
                                            'role_2_id' => $this->check_role($sym_10_roles[$i]),
                                            'relationship_type_id' => $this->check_my_relationship($sym_10_roles[$i])
                                        ]);

                                    //add data into patient, doctor , and question table
                                    $relative_doctor_id = DB::table('doctors')->insertGetId(
                                        ['doctor_name' => "ไม่ทราบ", 'doctor_mobile_phone' => "ไม่ทราบ",
                                            'doctor_phone' => "ไม่ทราบ", 'hospital' => "ไม่ทราบ", 'doctor_care_date' => "",
                                            'email' => "ไม่ทราบ"
                                        ]);

                                    $relative_patient_id = DB::table('patients')->insertGetId(
                                        ['doctor_id' => $relative_doctor_id, 'person_id' => $relative_person_id,
                                            'registration_date' => date('Y-m-d')
                                        ]);

                                    //In future, if our system support many disease types , we need to change where on disease_type_name_en to id
                                    $relative_disease_types = DB::table('disease_types')->where('disease_type_name_en', 'Duchenne muscular dystrophy, DMD')->first();
                                    // register disease type with question table
                                    $relative_disease_form_id = DB::table('disease_forms')->insertGetId(
                                        ['disease_type_id' => $relative_disease_types->disease_type_id]);

                                    DB::table('patients_disease_forms')->insert(
                                        ['patient_id' => $relative_patient_id, 'question_id' => $disease_form_id,
                                            'registration_date' => date('Y-m-d')
                                        ]);

                                    DB::table('disease_1')->insert(
                                        [
                                            'questions_id' => $relative_disease_form_id
                                        ]);
                                }
                            }
                        }
                        DB::commit();
                    }
                return response()->json(array('status' => 'Complete', 'message' => 'บันทึกสำเร็จ ', 'details' =>" : ) ") );   
             }
             return response()->json(array('status' => '3', 'message' => 'มาได้ยังไง '));
            }catch (Exception $e) {
                DB::rollback();
                if ($e->getCode() == 23000) {  
                    $result['status'] = 1;
                    $result['message'] = "Duplicate Record";
                    return response()->json($result, 200);
                } else {
                    $result['status'] = 2;
                    $result['message'] = $e->getMessage();
                return response()->json($result, 200);
                }
            }
    }


    /**
    * Display the specified resource.
    *
    * @param int $id
    *
    * @return Response
    */
   /* public function show_tree($id)
    {
        try{
            $result = array();
            $r =DB::table('persons')->where('person_citizenID', '=', $id)->first();
            if ( count($r) == 0 )
            {
                $result['Info']['status'] = "Error";
                $result['Info']['message'] = "No Person Found.";

                return response()->json($result, 200);
            }
            $result['Info']['status'] = "Success";
            $result['Info']['message'] = "";
            $result['person']['id']  = $r->person_id;
            $result['person']['title']['first_name']  = $r->person_first_name;
            $result['person']['title']['last_name'] = $r->person_last_name;
            $result['person']['description']['sex']  = $r->person_sex;
            $result['person']['description']['birth_date']  = $r->person_birth_date;
            $result['person']['description']['age']  = $r->person_age;
            $result['person']['description']['citizen_id']  = $r->person_citizenID;
            $result['person']['description']['house_num']  = $r->person_house_num;
            $result['person']['description']['mooh_num']  = $r->person_mooh_num;
            $result['person']['description']['soi']  = $r->person_soi;
            $result['person']['description']['road']  = $r->person_road;
            $result['person']['description']['tumbon']  = $r->person_tumbon;
            $result['person']['description']['amphur']  = $r->person_amphur;
            $result['person']['description']['province']  = $r->person_province;
            $result['person']['description']['post_code']  = $r->person_post_code;
            $result['person']['description']['phone']  = $r->person_phone;
            $result['person']['description']['mobile_phone']  = $r->person_mobile_phone;
            $result['person']['image']  = "";
            if($r->person_sex == "female"){
                $result['person']['itemTitleColor'] = "pink";
            }else{
                $result['person']['itemTitleColor'] = "";
            }
            $result['person']['groupTitle'] = "";
            $result['person']['groupTitlecolor'] = "";
            $relation_parent_array = array();
            // check parents for this guys
            $relation_parent = DB::table('relationship')
                ->where('person_1_id', '=', $r->person_id)
                ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
                ->where('relationship_type_description', '=', "พ่อเเม่")
                ->get();
            if(count($relation_parent) != 0 ){

                    $rp_array =array();
                     // find  dad
                    foreach ($relation_parent as $rp) {
                        $role_dad= DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                                                 ->where('role_description', '=', "พ่อ")
                                                 ->first();
                        if(count($role_dad) != 0){
                            $person_dad = DB::table('persons')
                                ->where('person_id', '=', $rp->person_2_id)
                                ->first();
                            $rp_array['first_name'] = $person_dad->person_first_name;
                            $rp_array['last_name'] = $person_dad->person_last_name;
                            $rp_array['role']=$role_dad->role_description;
                        }
                        // find mom
                        $role_mom= DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                                                 ->where('role_description', '=', "เเม่")
                                                 ->first();
                        if(count($role_mom) != 0){
                            $person_mom = DB::table('persons')
                                ->where('person_id', '=', $rp->person_2_id)
                                ->first();
                            $rp_array['first_name'] = $person_mom->person_first_name;
                            $rp_array['last_name'] = $person_mom->person_last_name;
                            $rp_array['role']=$role_mom->role_description;

                        }
                            array_push($relation_parent_array, $rp_array);
                    }
                    $result['person']['parents'] =$relation_parent_array;
                }else{
                    $result['person']['parents'] ="";
            }
            //find_married
            $relation_married = DB::table('relationship')
                ->where('person_1_id', '=', $r->person_id)
                ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
                ->where('relationship_type_description', '=', "คู่สมรส")
                ->first();
            if(count($relation_married) != 0 ){
                $role= DB::table('roles')->where('role_id', '=', $relation_married->role_2_id)->first();
                $person_2 = DB::table('persons')
                    ->where('person_id', '=', $relation_married->person_2_id)
                    ->first();
                $result['person']['spouses']['first_name'] = $person_2->person_first_name;
                $result['person']['spouses']['last_name'] = $person_2->person_last_name;
                $result['person']['spouses']['role']=$role->role_description;
            }else{
                $result['person']['spouses'] = "";
            }
            return response()->json($result, 200);
        }catch(Exception $e) {
            $result['Info']['status'] = "Error";
            $result['Info']['message'] = "$e";
            return response()->json($result, 200);
        }
    }
*/

    /**
    * Show the form for editing the specified resource.
    *
    * @param int $id
    *
    * @return Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    *
    *
    * @return Response
    */
    public function update(Request $request)
    {
        //
        try {


               /* DB::beginTransaction();
                $Person_id=Input::get('person_id');

                // keep the doctor profile
                $Doctor_id = DB::table('doctors')
                    ->where('doctor_id',Input::get('doctor_id'))
                    ->update(
                        ['doctor_name' => Input::get('doctor_name'), 'doctor_mobile_phone' => Input::get('doctor_mobilephonenumber'),
                            'doctor_phone' => Input::get('doctor_phonenumber'), 'hospital' => Input::get('hospital_name'), 'doctor_care_date' => Input::get('doctor_care_date') ,
                            'email' => Input::get('doctor_email')
                        ]);*/


                // insert information record
                /*  $symptom_checkbox_10 = Input::get('10_symptom_checkbox');
                  DB::table('disease_1')
                      ->where('questions_id' ,  Input::get('question_id'))
                      ->update(
                      ['symptom_1_1' => Input::get('1_1_symptom'), 'symptom_1_2' =>  Input::get('1_2_symptom'),
                          'symptom_1_3' => Input::get('1_3_symptom'), 'symptom_2' =>  Input::get('2_symptom_age'),
                          'symptom_3' => Input::get('3_symptom_age'), 'symptom_4_1' =>  Input::get('4_1_symptom'),
                          'symptom_4_2' => Input::get('4_2_symptom'), 'symptom_4_3' => Input::get('4_2_symptom'),
                          'symptom_4_4' => Input::get('4_4_symptom'), 'symptom_5' =>   Input::get('5_symptom'),
                          'symptom_5_date' => Input::get('5_2_symptom_add_on_result_date'), 'symptom_5_result' =>  Input::get('5_2_symptom_add_on_result'),
                          'symptom_6' => Input::get('6_symptom'), 'symptom_6_date' => Input::get('6_2_symptom_add_on_result_date'),
                          'symptom_6_result' => Input::get('6_2_symptom_add_on_result'), 'symptom_7_1' =>  Input::get('7_1_symptom'),
                          'symptom_7_1_result' => Input::get('7_1_symptom_result'), 'symptom_7_2' =>Input::get('7_2_symptom'),
                          'symptom_7_2_result' => Input::get('7_2_symptom_result'), 'symptom_7_3' =>  Input::get('7_3_symptom'),
                          'symptom_7_3_result' => Input::get('7_3_symptom_result'), 'symptom_8' => Input::get('8_1_symptom'),
                          'symptom_9_male' => Input::get('9_male_number'), 'symptom_9_female' =>Input::get('9_female_number'),
                          'symptom_10_2_male' => Input::get('10_2_male_number'), 'symptom_10_2_female' =>Input::get('10_2_female_number'),
                          'symptom_10_1' => Input::get('10_symptom') , 'symptom_10_1_number' => Input::get('10_symptom_number'),'symptom_10_1_check' => $symptom_checkbox_10 ,
                      ]);
                  $sym_10_name = json_decode(stripslashes(Input::get('vpb_item_name')));
                  $sym_10_age = json_decode(stripslashes(Input::get('vpb_item_ages')));
                  $sym_10_citizen_number = json_decode(stripslashes(Input::get('vpb_item_ids')));
                  $sym_10_roles =json_decode(stripslashes(Input::get('vpb_item_roles')));

                  if($symptom_checkbox_10 != "ไม่รู้") {
                      for($i = 0 ; $i < sizeof($sym_10_name) ; $i++){
                          $name = explode ( " " ,  $sym_10_name[$i]);
                          $relative_person_id = DB::table('persons')->insertGetId(
                              ['person_first_name' => $name[0], 'person_last_name' => $name[1],
                                  'person_age' => $sym_10_age[$i],'person_citizenID' => $sym_10_citizen_number[$i],
                                  'person_sex' => 'male'
                              ]);

                          DB::table('relationship')->insert(
                              ['person_1_id' => $Person_id, 'person_2_id' => $relative_person_id,
                                  'role_1_id' => $this->check_my_role($sym_10_roles[$i],$Person_id),
                                  'role_2_id' => $this->check_role($sym_10_roles[$i]),
                                  'relationship_type_id'=> $this->check_my_relationship($sym_10_roles[$i])
                              ]);
                      }
                  }*/
                //DB::commit();

                return response()->json(array('status' => 'Complete', 'message' => 'บันทึกสำเร็จ' ) ,200 );

        }catch (Exception $e) {
            DB::rollback();
            if ($e->getCode() == 23000) {
                $result['status'] = "Error";
                $result['message'] = "Duplicate Record";
                return response()->json($result, 200);
            } else {
                $result['status'] = 2;
                $result['message'] = $e->getMessage();
                return response()->json($result, 200);
            }
        }
    }


    /**
    * Remove the specified resource from storage.
    *
    * @param int $id
    *
    * @return Response
    */
    public function destroy($id)
    {
        //
    }
	
	
	public function view_form($person_id ,$type_id){

		return DB::table('persons')
            ->join('patients', 'patients.person_id', '=', 'persons.person_id')
			->join('doctors', 'doctors.doctor_id', '=', 'patients.doctor_id')	
            ->join('patients_disease_forms', 'patients_disease_forms.patient_id', '=', 'patients.patient_id')
			->join('disease_forms','disease_forms.question_id','=','patients_disease_forms.question_id')
			->join('disease_1', 'disease_1.questions_id', '=', 'patients_disease_forms.question_id')
            ->where('persons.person_id', '=', $person_id)
			->where('disease_forms.disease_type_id', '=', $type_id)
            ->first();
		
	}
	
	
}
