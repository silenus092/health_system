<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use DB;
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
                $Person_id = DB::table('persons')->insertGetId(
                ['person_first_name' => Input::get('first_name'), 'person_last_name' => Input::get('last_name'),
                'person_age' => Input::get('age'), 'person_sex' => Input::get('sex'),
                'person_citizenID' => Input::get('citizen_id'),    'person_birth_date' => Input::get('birth_date'),
                'person_house_num' => Input::get('ban_number'),    'person_soi' => Input::get('soi'),
                'person_road' => Input::get('road'),    'person_tumbon' => Input::get('sub_district'),
                'person_mooh_num' => Input::get('mooh_number'),    'person_amphur' => Input::get('district'),
                'person_province' => Input::get('province'),    'person_post_code' => Input::get('postal_code'),
                'person_mobile_phone' => Input::get('mobi_phone_number'),    'person_phone' => Input::get('house_number'),
                ]
                );

                $Doctor_id = DB::table('doctors')->insertGetId(
                ['doctor_name' => Input::get('doctor_name'), 'doctor_mobile_phone' => Input::get('doctor_mobilephonenumber'),
                'doctor_phone' => Input::get('doctor_phonenumber'), 'hospital' => Input::get('hospital_name'),
                'email' => Input::get('doctor_email')
                ]
                );

                $Patient_id = DB::table('patients')->insertGetId(
                ['doctor_id' => $Doctor_id, 'person_id' => $Person_id,
                'registration_date' => Input::get('doctor_care_date')
                ]
                );

                $disease_types = DB::table('disease_types')->where('disease_type_name_en', 'Duchenne muscular dystrophy, DMD')->first();

                $disease_form_id = DB::table('disease_forms')->insertGetId(
                ['disease_type_id' => $disease_types->disease_type_id] );

                DB::table('patients_disease_forms')->insert(
                ['patient_id' => $Patient_id, 'question_id' =>  $disease_form_id,
                'registration_date' => date('Y-m-d')
                ]
                );

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
                'symptom_10_1' => Input::get('10_symptom') , 'symptom_10_1_number' => Input::get('10_symptom_number'),
                'questions_id' =>  $disease_form_id
                ]
                );

                return response()->json(array('status' => 'Complete', 'message' => 'บันทึกสำเร็จ '));
            }
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                $result['status'] = 1;
                $result['message'] = 'Error: duplicate Record.';

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
public function show($id)
{
    //
}

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
 * @param int $id
 *
 * @return Response
 */
public function update($id)
{
    //
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
}
