<?php namespace App\Http\Controllers;

use App\Persons;
use DB;
use Input;

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
	public function update($id)
	{
		//
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
        // list person profile
        $person = DB::table('persons')
            ->where('person_id', '=', $person_id)
            ->first();

        if ($report_id != null && $person_id != null) { // For  DMD

            // get report form of DMD
				$result_callback =  DB::select('SELECT disease_1.*
				FROM  disease_forms ,patients_disease_forms ,disease_1 ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
               	AND disease_1.questions_id = disease_forms.question_id
				AND disease_forms.disease_type_id = '.$report_id.'
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person_id);


            $result_callback_header = DB::table('disease_types')
								->where('disease_type_id' ,'=', $report_id)
								->first();

            if (count($result_callback) > 0 && count($person)) {
					 return view('profile')
					->with('person' ,$person)
					->with('results',$result)
				    ->with('result_callback_header', $result_callback_header)
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
        $result = DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th ,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = ' . $person->person_id);

        /*$result = DB::table('disease_forms')
            ->join('patients_disease_forms', 'patients_disease_forms.question_id', '=', 'disease_forms.question_id')
            ->join('disease_types', 'disease_types.disease_type_id', '=', 'disease_forms.disease_type_id')
            ->where('patients_disease_forms.patient_id', '=' , $person->person_id)
            ->select('disease_forms.question_id','disease_types.disease_type_name_th', 'disease_types.disease_type_name_en')
            ->get();*/

        return view('profile')
            ->with('person', $person)
            ->with('results', $result)
            ->with('result_callback_header', null)
            ->with('result_callback', null);

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
