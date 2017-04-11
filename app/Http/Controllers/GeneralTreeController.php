<?php
/**
 * Created by IntelliJ IDEA.
 * User: ICT21
 * Date: 4/11/2017
 * Time: 1:04 PM
 */

namespace App\Http\Controllers;


class GeneralTreeController extends Controller
{

    private $data =  array();

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getTreeByID($keyID){

        $result = array();
        // get all relationship

        /*$name = Auth::user()->name;
     $staff_type = Auth::user()->staff_type;
     \Session::put('message', 'Welcome : '.$staff_type."<br>". $name);*/



        return view('general_tree')->with('disease_summary', $result);
    }
}