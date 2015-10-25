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

		return view('duchenne_report' )
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
