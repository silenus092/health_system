<?php namespace App\Http\Controllers;

use App\Persons;
use App\Relationship;
use DB;
use Input;
use StaticArray\StaticArray;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Symfony\Component\Security\Core\Authentication\RememberMe\PersistentToken;

class PersonController extends Controller {


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
	/*	DB::table('perosons')->whereHas('person_id', function($q) use ($input)
    {
        $q->where('cat_name', 'like', '%'.$input.'%')
				->orWhere('name', 'like', '%' . Input::get('name') . '%')->get();;

    })->get();*/
	 $persons = 	DB::table('persons')
						->select('person_id','person_first_name', 'person_last_name', 'person_citizenID')
            ->get();
						$data = array();
										 // find  dad
										foreach ($persons as $person) {
														$p = array();
														/*$p['firstname']  = $person->person_first_name ; // add dad to list
														$p['lastname'] = $person->person_last_name;
														$p['citizenID'] = $person->person_citizenID;*/
												        $p['ID'] = $person->person_id;
														$p['display'] = $person->person_id." ".$person->person_first_name." ".$person->person_last_name." ".$person->person_citizenID;
														$data[] = $p;
												}
				return response()->json($data, 200);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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
	public function update(Request $request)
	{
		//
        try {
            $relationship_debug = "None";
            if ($request->ajax()) {
                DB::beginTransaction();
                $Person_id=Input::get('person_id');

                    // keep the doctor profile
                    $Doctor_id = DB::table('doctors')
                        ->where('doctor_id',Input::get('doctor_id'))
                        ->update(
                        ['doctor_name' => Input::get('doctor_name'), 'doctor_mobile_phone' => Input::get('doctor_mobilephonenumber'),
                            'doctor_phone' => Input::get('doctor_phonenumber'), 'hospital' => Input::get('hospital_name'),
                            'doctor_care_date' => Input::get('doctor_care_date') ,
                            'email' => Input::get('doctor_email')
                        ]);


                // insert information record
                $symptom_checkbox_10 = Input::get('10_symptom_checkbox');
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

                    if($symptom_checkbox_10 != "ไม่รู้" || $symptom_checkbox_10==null ||  !isset($symptom_checkbox_10) ) {
                        $relationship_debug = "เข้ามาเเล้ส";
                        for($i = 0 ; $i < sizeof($sym_10_name) ; $i++){
                            $relationship_debug = "เข้ามาเเล้ส 1";
                            if($sym_10_name[$i] != ' '   && $sym_10_name[$i] != null) {
                                $name = explode ( " " ,  $sym_10_name[$i]);

                                $user = Persons::firstOrNew(array('person_first_name' => $name[0] ,'person_last_name' => $name[1] ));
                                $user->person_first_name = $name[0];
                                $user->person_last_name = $name[1];
                                $user->person_age = $sym_10_age[$i];
                                $user->person_citizenID = $sym_10_citizen_number[$i];
                                $user->person_sex = 'male';
                                $user->save();
                                $relative_person_id =  $user->person_id;
                                /*$relative_person_id = DB::table('persons')->insertGetId(
                                    ['person_first_name' => $name[0], 'person_last_name' => $name[1],
                                        'person_age' => $sym_10_age[$i],'person_citizenID' => $sym_10_citizen_number[$i],
                                        'person_sex' => 'male'
                                    ]);*/

                                $relationship =Relationship::where('person_1_id', '=', $Person_id)
                                    ->where('person_2_id', '=', $relative_person_id)
                                    ->first();

                                if($relationship->exists){
                                    $relationship_debug = "เข้ามาเเล้ส 2";
                                    $relationship->role_1_id =  $this->check_my_role($sym_10_roles[$i],$Person_id);
                                    $relationship->role_2_id = $this->check_role($sym_10_roles[$i]);
                                    $relationship->relationship_type_id = $this->check_my_relationship($sym_10_roles[$i]);
                                    $relationship->save();

                                }else {
                                    $relationship = Relationship::where('person_2_id', '=', $Person_id)
                                        ->where('person_1_id', '=', $relative_person_id)
                                        ->first();
                                    if($relationship->exists){
                                        $relationship_debug = "เข้ามาเเล้ส 3";
                                        $relationship->role_2_id =  $this->check_my_role($sym_10_roles[$i],$Person_id);
                                        $relationship->role_1_id = $this->check_role($sym_10_roles[$i]);
                                        $relationship->relationship_type_id = $this->check_my_relationship($sym_10_roles[$i]);
                                        $relationship->save();
                                    }else{
                                        $relationship_debug = "เข้ามาเเล้ส 4";

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
                                        $relative_disease_types = DB::table('disease_types')->where('disease_type_name_en', StaticArray::$diseases['DMD'])->first();
                                        // register disease type with question table
                                        $relative_disease_form_id = DB::table('disease_forms')->insertGetId(
                                            ['disease_type_id' => $relative_disease_types->disease_type_id]);

                                        DB::table('patients_disease_forms')->insert(
                                            ['patient_id' => $relative_patient_id, 'question_id' => $relative_disease_form_id,
                                                'registration_date' => date('Y-m-d')
                                            ]);

                                        DB::table('disease_1')->insert(
                                            [
                                                'questions_id' => $relative_disease_form_id
                                            ]);
                                        DB::table('relationship')->insert(
                                            ['person_1_id' => $Person_id, 'person_2_id' => $relative_person_id,
                                                'role_1_id' => $this->check_my_role($sym_10_roles[$i],$Person_id),
                                                'role_2_id' => $this->check_role($sym_10_roles[$i]),
                                                'relationship_type_id'=> $this->check_my_relationship($sym_10_roles[$i])
                                            ]);
                                    }

                                }
                            }

                        }
                    }
                    DB::commit();

                return response()->json(array('status' => 'Complete', 'message' => 'บันทึกสำเร็จ ' ) ,200 );
            }
            return response()->json(array('status' => 'Error', 'message' => 'มาได้ยังไง ') ,200);
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( )
	{
		try{

			 DB::statement('SET FOREIGN_KEY_CHECKS = 0');
			DB::beginTransaction();
			$id = Input::get('person_id');
			// check this guy exist or not

			$patient =DB::table('patients')->where('person_id', '=', $id)->first();
			if ( count($patient) > 0 )
			{
			$patients_disease_forms = DB::table('patients_disease_forms')
				->where('patient_id', '=', $id)->get();
			if(count($patients_disease_forms) >0 ){
				foreach($patients_disease_forms as $pdf){
					 DB::table('disease_1')->where('questions_id', '=', $pdf->question_id)->delete();
				}
                $patients_disease_forms->delete();
			}
			DB::table('patients')->where('person_id', '=', $id)->delete();
                DB::table('doctors')->where('doctor_id', '=', $patient->doctor_id)->delete();

			}

		    DB::table('relationship')->where('person_1_id', '=', $id)->delete();
			DB::table('relationship')->where('person_2_id', '=', $id)->delete();
			DB::table('persons')->where('person_id', '=', $id)->delete();
			DB::commit();
			DB::statement('SET FOREIGN_KEY_CHECKS = 1');
			$result['status'] = "Success";
			$result['message'] = "Good bye";
			return response()->json($result, 200);

		}catch (Exception $e) {
			DB::rollback();
			$result['status'] = "Error";
			$result['message'] = $e->getMessage();
			return response()->json($result, 200);
		}
	}

	public function clear_relationship($person_id){
		try{

		    DB::statement('SET FOREIGN_KEY_CHECKS = 0');
			DB::beginTransaction();
			$id = $person_id;
			// check this guy exist or not
			$patient =DB::table('patients')->where('person_id', '=', $id)->first();
			if ( count($patient) > 0 )
			{
			$patients_disease_forms = DB::table('patients_disease_forms')
				->where('patient_id', '=', $id)->get();
			if(count($patients_disease_forms) >0 ){
				foreach($patients_disease_forms as $pdf){
					 DB::table('disease_1')->where('questions_id', '=', $pdf->question_id)->delete();
				}
                $patients_disease_forms->delete();
			}
                DB::table('patients')->where('person_id', '=', $id)->delete();
		    DB::table('doctors')->where('doctor_id', '=', $patient->doctor_id)->delete();

            }
		    DB::table('relationship')->where('person_1_id', '=', $id)->delete();
			DB::table('relationship')->where('person_2_id', '=', $id)->delete();
			DB::commit();
			DB::statement('SET FOREIGN_KEY_CHECKS = 1');
			$result['status'] = "Success";
			$result['message'] = "Good bye";
			return response()->json($result, 200);

        } catch (Exception $e) {
			DB::rollback();
			$result['status'] = "Error";
			$result['message'] = $e->getMessage();
			return response()->json($result, 200);
		}
	}
	
	public function show_report_by_type($report_id = null , $person_id = null){
        // list all medical care
        $result = DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th 								,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person_id);
        //  list person profile
        $person = DB::table('persons')
            ->where('person_id', '=', $person_id)
            ->first();

        if ($report_id != null && $person_id != null) { // For  DMD

            // get report form of DMD
				$result_callback =  DB::select('SELECT disease_1.* ,doctors.*
				FROM  disease_forms ,patients_disease_forms ,disease_1 ,patients ,doctors
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
               	AND disease_1.questions_id = disease_forms.question_id
				AND disease_forms.disease_type_id = '.$report_id.'
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person_id .'
                AND patients.doctor_id  = doctors.doctor_id');
            // get all relationships between person_id
                    $result_relation = DB::select('SELECT persons.person_first_name ,persons.person_last_name ,persons.person_citizenID ,filtered_role.*
                                                FROM persons ,
                                                    (SELECT *
                                                    FROM  relationship
                                                    WHERE person_1_id = '.$person_id.' OR person_2_id = '.$person_id.') as relationship  ,
                                                    ( SELECT  *
                                                     FROM   roles
                                                     WHERE  role_id IN (1,3,5,7,9,11,13,15,17,19,24) ) as filtered_role
                                                WHERE (relationship.role_1_id  = filtered_role.role_id AND persons.person_id  = relationship.person_1_id AND relationship.person_1_id != '.$person_id.' ) OR 
                                                ( persons.person_id = relationship.person_2_id AND relationship.person_2_id != '.$person_id.' AND relationship.role_2_id = filtered_role.role_id )
                                                GROUP by persons.person_first_name ,persons.person_last_name ,persons.person_citizenID ,filtered_role.role_description ');



            $result_callback_header = DB::table('disease_types')
								->where('disease_type_id' ,'=', $report_id)
								->first();


            if (count($result_callback) > 0 && count($person)) {
					 return view('profile')
					->with('person' ,$person)
					->with('results',$result)
				    ->with('result_callback_header', $result_callback_header)
                    ->with('result_relation',$result_relation)
					->with('result_callback',$result_callback);

				}else{
					$this->show();
				}
		}else{
			 return view('profile')
					->with('person' ,$person)
					->with('results',$result)
				    ->with('result_callback_header', "Error")
					->with('result_callback',"Cannot find patient profile");
		}
	}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show()
    {
        $name = explode(" ", Input::get('search_patient-query'));


        $person = DB::table('persons')
            ->where('person_id', '=', $name[0])
            ->first();
        if(count($person)>0)
        {
            $result = DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th ,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = ' . $person->person_id);
            return view('profile')
                ->with('person', $person)
                ->with('results', $result)
                ->with('result_callback_header', null)
                ->with('result_callback', null);
        } else{
            $Total  = DB::select('SELECT count(disease_forms.question_id) as  total , disease_type_name_en ,disease_type_name_th
                                FROM disease_forms
                                RIGHT JOIN disease_types
                                ON disease_types.disease_type_id = disease_forms.disease_type_id
                                Group by disease_type_name_en , disease_type_name_th');
            $data = array();
            for($i = 0 ; $i < count($Total) ; $i++){
                $data[]='{name:"'.$Total[$i]->disease_type_name_en.'",y:'.$Total[$i]->total.'}';
            }
            return redirect()->back()->with('no_result' , true)->with('disease_summary' , $data);

        }
        /*$result = DB::table('disease_forms')
            ->join('patients_disease_forms', 'patients_disease_forms.question_id', '=', 'disease_forms.question_id')
            ->join('disease_types', 'disease_types.disease_type_id', '=', 'disease_forms.disease_type_id')
            ->where('patients_disease_forms.patient_id', '=' , $person->person_id)
            ->select('disease_forms.question_id','disease_types.disease_type_name_th', 'disease_types.disease_type_name_en')
            ->get();*/

    }
	
	public function upload_image() {
		$destinationPath = '../uploads/';
		$id = Input::get('person_id');
		$file = Input::file('file');
		$today = date("Y-m-d-H-i-s"); 
		$w = 0 ;
		$h =  0 ;
		if (Input::file('file')->isValid())
		{
            $person = DB::table('persons')
                ->where('person_id' ,'=',$id)->first();
			$filename = $file->getClientOriginalName();

            if(file_exists( public_path() . '/uploads/' .$person->profile_img)) {
                \File::Delete(public_path() . '/uploads/' .$person->profile_img);
            }
            DB::table('persons')
					  ->where('person_id' ,'=',$id)
				      ->update(['profile_img' =>$today."-".$id."-".$filename]);
            $img = \Image::make($file)->fit(300, 300)->save('../public/uploads/' . $today . "-" . $id . "-" . $filename);
            $result["status"] = "Complete";
			return response()->json($result, 200);
		}else{
            $result["status"] = "Error";

			return response()->json($result, 200);
		}

		
	}

    /**
     * @description
     * This method is used for update age
     *
     * @param
     *
     * @POST pk , value
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function update_age()
    {

        try {
            $personId = Input::get('pk');
            $newValue = Input::get('value');
            $personData = Persons::wherepersonId($personId)->first();
            $personData->person_birth_date = $newValue;

            list($year, $month, $day) = explode("-", $newValue);
            $year_diff = date("Y") - $year;
            $month_diff = date("m") - $month;
            $day_diff = date("d") - $day;
            if ($day_diff < 0 && $month_diff == 0) {
                $year_diff--;
            }
            if ($day_diff < 0 && $month_diff < 0) {
                $year_diff--;
            }
            $personData->person_age = $year_diff;

            if ($personData->save())
                return response()->json(array('status' => "Complete"));
            else
                return response()->json(array('status' => 'Error'));
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }

    public function update_CitizenID()
    {

        try {
            $personId = Input::get('pk');

            $newValue = Input::get('value');

            $personData = Persons::wherepersonId($personId)->first();
            $personData->person_citizenID = $newValue;
            if ($personData->save())
                return response()->json(array('status' => "Complete"));
            else
                return response()->json(array('status' => 'Error'));
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }


    public function update_Gender()
    {

        try {
            $personId = Input::get('pk');

            $newValue = Input::get('value');

            $personData = Persons::wherepersonId($personId)->first();
            $personData->person_sex = $newValue;
            if ($personData->save())
                return response()->json(array('status' => "Complete"));
            else
                return response()->json(array('status' => 'Error'));
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }


    public function update_Landline()
    {

        try {
            $personId = Input::get('pk');

            $newValue = Input::get('value');

            $personData = Persons::wherepersonId($personId)->first();
            $personData->person_phone = $newValue;
            if ($personData->save())
                return response()->json(array('status' => "Complete"));
            else
                return response()->json(array('status' => 'Error'));
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }


    public function update_Mobile()
    {

        try {
            $personId = Input::get('pk');

            $newValue = Input::get('value');

            $personData = Persons::wherepersonId($personId)->first();
            $personData->person_mobile_phone = $newValue;
            if ($personData->save())
                return response()->json(array('status' => "Complete"));
            else
                return response()->json(array('status' => 'Error'));
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }

    public function update_Address()
    {

        try {
            $personId = Input::get('pk');
            $newValue = Input::get('value');

            $personData = Persons::wherepersonId($personId)->first();
            $personData->person_road = $newValue['street'];
            $personData->person_soi = $newValue['soi'];
            $personData->person_mooh_num = $newValue['mooh'];
            $personData->person_house_num = $newValue['house_number'];
            $personData->person_tumbon = $newValue['tumbon'];
            $personData->person_amphur = $newValue['amphur'];
            $personData->person_province = $newValue['province'];
            $personData->person_post_code = $newValue['post_code'];

            if ($personData->save())
                return response()->json(array('status' => "Complete "));
            else
                return response()->json(array('status' => 'Error'));
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }

}
