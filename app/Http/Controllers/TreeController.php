<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB ;
use Input;

class TreeController extends Controller
{
	
	public function index($ID = null)
	{
		$citizen_id = $ID;
		return view('tree' )
				->with('citi_id' ,$citizen_id);
	}
}


?>