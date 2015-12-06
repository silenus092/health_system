<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
														$p['display'] = $person->person_first_name." ".$person->person_last_name." ".$person->person_citizenID;
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
								->where('person_first_name' ,'=', $name[0])
								->where('person_last_name' ,'=', $name[1])
								->where('person_citizenID' ,'=', $name[2])
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
	public function destroy($id)
	{
		//
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

}
