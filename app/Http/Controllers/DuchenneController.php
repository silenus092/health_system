<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB ;
use Input;
class DuchenneController extends Controller {

	/**
	* Display a listing of the resource.
	*
	* @return Response
	*/
	public function index()
	{
		// Find Total records
		$Duchenne_total = DB::select('SELECT  count(disease_1.questions_id) as total FROM disease_1 ');
		// Find Family nubmer
		$Family_total = DB::select('SELECT  COUNT(family_name.person_last_name) as total
		FROM ( SELECT persons.person_id, persons.person_last_name, COUNT(persons.person_last_name) as count
				FROM persons, patients , patients_disease_forms , disease_forms
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
				AND patients_disease_forms.patient_id = patients.patient_id
				AND patients.person_id = persons.person_id
				AND disease_forms.disease_type_id = 1
				GROUP BY person_last_name ) as family_name
		');
		//Find  multiple PCR
		$PCR = DB::select('SELECT disease_1_abnormal.abnormal as abnormal, count(disease_1.questions_id) as total FROM disease_1,  (SELECT count(symptom_7_1) as abnormal FROM disease_1 WHERE symptom_7_1 = "ผิดปกติ" ) as disease_1_abnormal');
		//FInd MLPA
		$MLPA = DB::select('SELECT  disease_1_abnormal.abnormal as abnormal , count(disease_1.questions_id) as total FROM disease_1,

		(SELECT count(symptom_7_2) as abnormal FROM disease_1 	WHERE symptom_7_2 = "ผิดปกติ" ) as disease_1_abnormal
		');
		//Find Sequencing
		$Sequencing = DB::select('SELECT disease_1_abnormal.abnormal as abnormal, count(disease_1.questions_id) as total FROM disease_1,

		(SELECT count(symptom_7_3) as abnormal FROM disease_1 	WHERE symptom_7_3 = "ผิดปกติ" ) as disease_1_abnormal
		');
		// Find who didn't take treatment.
		$DontTakeTreatment = DB::select('SELECT count(disease_1.questions_id) as total_not_treatment FROM disease_1
		where symptom_7_1 = "ไม่ได้ตรวจ" and symptom_7_2 = "ไม่ได้ตรวจ" and  symptom_7_3 = "ไม่ได้ตรวจ"	');
		// Find who take any treatment.
		$TakeAnyTreatment = DB::select('SELECT count(disease_1.questions_id) as total_any_treatment FROM disease_1
		where symptom_7_1 != "ไม่ได้ตรวจ" or symptom_7_2 != "ไม่ได้ตรวจ" or  symptom_7_3 != "ไม่ได้ตรวจ"
		');

		//Find  Attention Deficit Disorder
		$Attention_Deficit_Disorder = DB::select('SELECT  count(questions_id) as disorder
		FROM disease_1
		where symptom_4_1 = "เป็น" ');
		//FInd Autistic
		$Autistic = DB::select(' SELECT count(disease_1.questions_id) as disorder
		FROM disease_1
		where symptom_4_2 = "เป็น" ');
		//Find Snorring
		$Snorring = DB::select(' SELECT count(disease_1.questions_id) as disorder
		FROM disease_1
		where symptom_4_3 = "เป็น" ');
		// Find  tired
		$Tired = DB::select(' SELECT count(disease_1.questions_id) as  disorder
		FROM disease_1
		where symptom_4_4 = "เป็น"	');


		// Find Echocardiogram
		$Echocardiogram= DB::select('SELECT count(disease_1.questions_id) as tested FROM disease_1 where symptom_6 = "ตรวจ" ');
		$UnEchocardiogram= DB::select('SELECT count(disease_1.questions_id) as un_test FROM disease_1 where symptom_6 = "ไม่ได้ตรวจ" ');
		$Echocardiogram_noresult =  DB::select('SELECT persons.person_id , persons.person_first_name , persons.person_last_name ,persons.person_sex
			FROM  persons ,patients ,disease_1 ,patients_disease_forms
			where patients_disease_forms.question_id  = disease_1.questions_id
			AND patients_disease_forms.patient_id = patients.patient_id
			AND patients.person_id = persons.person_id
			AND disease_1.symptom_6 = "ตรวจ" AND disease_1.symptom_6_result = "" ');

			// Find CK
			$Ck= DB::select('SELECT count(disease_1.questions_id) as tested FROM disease_1 where symptom_5 = "มี" ');
			$UnCk= DB::select('SELECT count(disease_1.questions_id) as un_test FROM disease_1 where symptom_5 = "ไม่มี" ');
			$Ck_noresult =  DB::select('SELECT persons.person_id , persons.person_first_name , persons.person_last_name ,persons.person_sex
				FROM  persons ,patients ,disease_1 ,patients_disease_forms
				where patients_disease_forms.question_id  = disease_1.questions_id
				AND patients_disease_forms.patient_id = patients.patient_id
				AND patients.person_id = persons.person_id
				AND disease_1.symptom_5 = "มี" AND disease_1.symptom_5_result = "" ');

				//Find hostpital

				return view('duchenne_report' )
				->with('Duchenne_total' ,$Duchenne_total)
				->with('Family_total' ,$Family_total)
				->with('Attention_Deficit_Disorder' ,$Attention_Deficit_Disorder)
				->with('Autistic' ,$Autistic)
				->with('Snorring' ,$Snorring)
				->with('Tired', $Tired)
				->with('Echocardiogram' ,$Echocardiogram)
				->with('UnEchocardiogram' ,$UnEchocardiogram)
				->with('Echocardiogram_noresult' ,$Echocardiogram_noresult)
				->with('Ck' ,$Ck)
				->with('UnCk' ,$UnCk)
				->with('Ck_noresult' ,$Ck_noresult)
				->with('TakeAnyTreatment' , $Attention_Deficit_Disorder)
				->with('DontTakeTreatment' , $Autistic)
				->with('PCR' ,$Snorring)
				->with('MLPA' ,$Tired)
				->with('TakeAnyTreatment' , $TakeAnyTreatment)
				->with('DontTakeTreatment' , $DontTakeTreatment)
				->with('PCR' ,$PCR)
				->with('MLPA' ,$MLPA)
				->with('Sequencing' ,$Sequencing);
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
			public function show($id)
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
			public function destroy($id)
			{
				//
			}

		}
