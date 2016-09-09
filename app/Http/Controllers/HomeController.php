<?php

namespace App\Http\Controllers;
use Auth;
use DB;
class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |
    */

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
		
		   /*$name = Auth::user()->name;
			$staff_type = Auth::user()->staff_type;
        	\Session::put('message', 'Welcome : '.$staff_type."<br>". $name);*/

        $Total  = DB::select('SELECT count(disease_forms.question_id) as  total , disease_type_name_en ,disease_type_name_th
                                FROM disease_forms
                                RIGHT JOIN disease_types
                                ON disease_types.disease_type_id = disease_forms.disease_type_id
                                Group by disease_type_name_en , disease_type_name_th');
        $data = array();
        for($i = 0 ; $i < count($Total) ; $i++){
            $data[]='{name:"'.$Total[$i]->disease_type_name_en.'",y:'.$Total[$i]->total.'}';
        }

        return view('home')->with('disease_summary', $data);
    }
}
