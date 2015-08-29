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
							$id = DB::table('person')->insertGetId(
						    ['person_first_name' =>Input::get('first_name'), 'person_last_name' =>Input::get('last_name'),
								'person_age' =>   Input::get('age'), 'person_sex' =>Input::get('sex'),
                'person_citizenID' => Input::get('citizen_id'), 	'person_birth_date' =>  Input::get('birth_date'),
                'person_house_num' => Input::get('citizen_id'), 	'person_soi' =>  Input::get('birth_date'),
                'person_road' => Input::get('citizen_id'), 	'person_tumbon' =>  Input::get('birth_date'),
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
