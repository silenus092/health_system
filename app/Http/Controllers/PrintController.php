<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use Illuminate\Http\Request;
use DB ;
class PrintController extends Controller 
{
    public function index()
    {

    }
	
	public function view_pdf($id =  null ,$type = null){

		$form_controller =	new FormController();
		$patient_report =  $form_controller->view_form($id , $type);
		//var_dump($this->view_form($id , $type));
		if(count($patient_report)>0){
			
		
		$html_view =  \View::make('pages.form.form_create_pdf', compact('patient_report'))->render();
		$pdf = \App::make('mpdf.wrapper',['th','A4','','',10,10,10,10,10,5]);
       // $pdf = \App::make('mpdf.wrapper');
        $pdf->loadHTML(  $html_view );
		
       $pdf->stream($patient_report->person_citizend_id.'_'.$patient_report->disease_type_name_en.'.pdf');
		}else{
			
				$result =  DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th 								,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $person_id);
			
			
				$person = DB::table('persons')
								->where('person_id' ,'=', $person_id )
								->first();
	
				
			 return view('profile')
					->with('person' ,$person)
					->with('results',$result)
				    ->with('result_callback_header', "Error")
					->with('result_callback',"Cannot find patient profile"); 
		}
	

	
	}
	/*
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
		
	}*/
}

?>