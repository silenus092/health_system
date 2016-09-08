<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use Elibyy\TCPDF\Facades\Pdf;
use Illuminate\Http\Request;
use Elibyy\TCPDF\Facades\TCPDF;
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
         //$pdf = \App::make('mpdf.wrapper');
            $pdf->setFooter('{PAGENO} / {nb}');
         $pdf->loadHTML(  $html_view );
         $pdf-> SetTitle($patient_report->person_first_name.' '.$patient_report->person_last_name.'_'.$patient_report->disease_type_name_en);
		 $pdf->stream($patient_report->person_first_name.' '.$patient_report->person_last_name.'_'.$patient_report->disease_type_name_en.'.pdf');



           /* $html_view =  \View::make('pages.form.form_create_pdf', compact('patient_report'))->render();
           // return $html_view;
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            $pdf->SetFont('freeserif', '', 10); //ภาษาไทยใช้ได้
            $pdf-> SetTitle($patient_report->person_first_name.' '.$patient_report->person_last_name.'_'.$patient_report->disease_type_name_en);
            $pdf-> AddPage();
            $pdf-> writeHTML($html_view, true, false, true, false, '');
            $pdf-> Output($patient_report->person_first_name.' '.$patient_report->person_last_name.'_'.$patient_report->disease_type_name_en.'.pdf');

*/
		}else{
			
				$result =  DB::select('SELECT disease_types.disease_type_id ,disease_type_name_th 								,disease_type_name_en
				FROM  disease_forms ,patients_disease_forms ,disease_types ,patients
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
                AND disease_types.disease_type_id = disease_forms.disease_type_id
				AND patients_disease_forms.patient_id =  patients.patient_id
				AND patients.person_id = '. $id);
			
			
				$person = DB::table('persons')
								->where('person_id' ,'=', $id )
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