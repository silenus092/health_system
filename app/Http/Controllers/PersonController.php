<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

use Illuminate\Http\Request;
use DB ;
use Input;
class PersonController extends Controller {

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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$name = explode ( " " , Input::get('search_patient-query'));
		
		
		$person = DB::table('persons')
								->where('person_id' ,'=', $name[0])
								
								->first();
		$result =  DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th ,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person->person_id);
		
		/*$result = DB::table('disease_forms')
			->join('patients_disease_forms', 'patients_disease_forms.question_id', '=', 'disease_forms.question_id')
            ->join('disease_types', 'disease_types.disease_type_id', '=', 'disease_forms.disease_type_id')
			->where('patients_disease_forms.patient_id', '=' , $person->person_id)
            ->select('disease_forms.question_id','disease_types.disease_type_name_th', 'disease_types.disease_type_name_en')
            ->get();*/
		
		return view('profile')
					->with('person' ,$person)
					->with('results',$result)
					->with('result_callback_header', null)
					->with('result_callback',null);
	
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
				->where('patient_id', '=', $patient_id)->get();
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
				->where('patient_id', '=', $patient_id)->get();
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
		
		}catch (Exception $e) {
			DB::rollback();
			$result['status'] = "Error";
			$result['message'] = $e->getMessage();
			return response()->json($result, 200);
		}
	}
	
	public function show_report_by_type($report_id = null , $person_id = null){
		
		
		if($report_id !=null && $person_id!= null){ // Fuck Duchenne
				$result =  DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th 								,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person_id);
			
				$result_callback =  DB::select('SELECT disease_1.*
				FROM  disease_forms ,patients_disease_forms ,disease_1 ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
               	AND disease_1.questions_id = disease_forms.question_id
				AND disease_forms.disease_type_id = '.$report_id.'
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person_id);
			
				$person = DB::table('persons')
								->where('person_id' ,'=', $person_id )
								->first();
	
				 $result_callback_header = DB::table('disease_types')
								->where('disease_type_id' ,'=', $report_id)
								->first();
				
				if(count($result_callback)>0 && count($person)){
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
	
	public function upload_image() {
		$destinationPath = '../uploads/';
		$id = Input::get('person_id');
		$file = Input::file('file');
		$today = date("Y-m-d-H-i-s"); 
		$w = 0 ;
		$h =  0 ;
		if (Input::file('file')->isValid())
		{
			$filename = $file->getClientOriginalName();
		    $person = DB::table('persons')
					  ->where('person_id' ,'=',$id)
				      ->update(['profile_img' =>$today."-".$filename]);
					
			//$uploaded_image=Input::file('file')->move($destinationPath, $filename);
			$img = \Image::make($file)->resize(300, 300)->save('../public/uploads/'.$today."-".$filename);
			$result['status'] = "Complete";
			return response()->json($result, 200);
		}else{
			$result['status'] = "Complete";

			return response()->json($result, 200);
		}

		
	}

}
