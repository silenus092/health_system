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
                $Person_id = DB::table('person')->insertGetId(
                ['person_first_name' =>Input::get('first_name'), 'person_last_name' =>Input::get('last_name'),
                'person_age' =>   Input::get('age'), 'person_sex' =>Input::get('sex'),
                'person_citizenID' => Input::get('citizen_id'), 	'person_birth_date' =>  Input::get('birth_date'),
                'person_house_num' => Input::get('ban_number'), 	'person_soi' =>  Input::get('soi'),
                'person_road' => Input::get('road'), 	'person_tumbon' =>  Input::get('sub_district'),
                'person_mooh_num' => Input::get('mooh_number'), 	'person_amphur' =>  Input::get('district'),
                'person_province' => Input::get('province'), 	'person_post_cost' =>  Input::get('postal_code'),
                'person_mobile_phone' => Input::get('mobi_phone_number'), 	'person_phone' =>  Input::get('house_number')
                ]

                $Doctor_id = DB::table('doctor')->insertGetId(
                ['doctor_name' =>Input::get('doctor_name'), 'doctor_mobile_phone' =>Input::get('doctor_mobilephonenumber'),
                'doctor_phone' =>   Input::get('doctor_phonenumber'), 'hospital' =>Input::get('hospital_name'),
                'email' => Input::get('doctor_email')
                ]
                );

                $Patient_id = DB::table('patients')->insertGetId(
                ['doctor_id' =>$Doctor_id, 'person_id' =>$Person_id,
                'registration_date' =>   Input::get('doctor_care_date')
                ]
                );
                 // use date function  temporary
                $disease_form_id = DB::table('disease_forms')->insertGetId(
                ['doctor_id' =>$Doctor_id, 'disease_types' =>"ดูเชน, Duchenne muscular dystrophy, DMD",
                'question_date' =>  date("Y-m-d")
                ]
                );

                DB::table('disease_1')->insert(
                ['doctor_id' =>$Doctor_id, 'disease_types' =>"ดูเชน, Duchenne muscular dystrophy, DMD",
                'registration_date' =>   Input::get('doctor_care_date')
                ]
                );

                DB::table('disease_1')->insert(
                ['patient_id' =>$Patient_id, 'question_id' =>$disease_form_id,
                'registration_date' =>  date("Y-m-d")
                ]
                );


            return response()->json(array('status' => 'Complete', 'message' => 'บันทึกสำเร็จ ' )) ;
        }
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {
            $result['status'] = 1;
            $result['message'] = 'Error: duplicate Record.';

            return response()->json($result, 200 ) ;
        } else {
            $result['status'] = 2;
            $result['message'] = $e->getMessage();
            return response()->json($result, 200 ) ;

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
