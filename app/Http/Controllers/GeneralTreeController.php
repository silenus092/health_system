<?php
/**
 * Created by IntelliJ IDEA.
 * User: ICT21
 * Date: 4/11/2017
 * Time: 1:04 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class GeneralTreeController extends Controller
{

    private $TreeIDList =  array();
    private $TreeIDInfectedList = array();
    private  $data = array();
    public function __construct()
    {
        // for development
        //  $this->middleware('auth');
    }

    public function getTreeByID($keyID){

        $result = array();

        $persons = 	DB::table('persons')->where('person_id' , '=' , $keyID)
            ->select('person_id','person_first_name', 'person_last_name', 'person_citizenID')
            ->first();
        if(count($persons) == 0 ){
            $result['status'] = "Success";
            $result['message'] = "No person found on ID: ".$keyID;
            return response()->json($result, 200);
        }

      //  echo  $persons->person_citizenID ." ";
       /* $result = '{
            focusId: 3,
            confirmIds: [3, 4],
            data:
                [
                { key: -50, n: "เทพสุธา ธนันสิดากร 39 y ", s: "M", ux: -51, a: ["F1", "F2", "F3", "F4", "S"] },
                { key: -51, n: "จิรดาณัท ธนันสิดากร 34 y ", s: "F", a: ["S"] },
                { key: 3, n: "พรรณพรรษ นันท์วิชกรณ์ 24 y", s: "F", m: -50, f: -51, a: ["FO1", "FO2", "FO3", "FO4", "B1", "B2", "B3", "B4"] },
                { key: 4, n: "ภัณณิพงศ์ ธนันสิดากร 27 y", s: "M", ux: 3, a: ["TH1", "TH2", "TH3"] },
                { key: 5, n: "พงษ์ธณัฐ  ธนันสิดากร 4 y", s: "M", m: 3, f: 4, a: ["FO1", "FO2", "FO3", "FO4"] },
                { key: 6, n: "นารีรัตน์ ธนันสิดากร 1 m 1 w", s: "N", m: 3, f: 4 },
                { key: 1, n: "ปัณน์ญะพัทธ์ ธนันสิดากร 22 y", s: "M", m: -50, f: -51, a: ["TW1", "TW2", "TW3", "TW4", "B1", "B2", "B3", "B4"] },
                { key: 2, n: "มณจนาภัทธ์ ธนันสิดากร 20 y", s: "F", m: -50, f: -51, a: ["F1", "F2", "F3", "F4", "S"] }
                ]
        }';*/

        $result['focusId'] = $persons->person_id;
        $this->TreeIDList[] = $persons->person_id;
       // print_r( $this->TreeIDList);
        while (count($this->TreeIDList) > 0 ) {
            $key = array_shift($this->TreeIDList);
            if ((!$this->check_key_has_exists_valueByGeneralTree($this->data, 'key', $key)) && $key != null) {

                $row = array();

                $row = $this->setPersonalInfo($row, $key);
                $this->findInfectedByID($key);


               // print_r($row);

                $this->data[] = $row;

                //print_r($this->data);

            }
        }

        $result['data'] =$this->data;
        $result['confirmIds'] = $this->TreeIDInfectedList;

        $responsecode = 200;

        $header = array (
            'Content-Type' => 'application/json; charset=UTF-8',
            'charset' => 'utf-8'
        );

        return  response()->json($result , $responsecode, $header, JSON_UNESCAPED_UNICODE);
        //return view('general_tree')->with('result', $result);
    }

    public function findInfectedByID($ID){
        // find  only Duchenne

        $person = DB::select('SELECT persons.person_id , persons.person_first_name , persons.person_last_name ,persons.person_citizenID
				FROM  persons ,patients ,disease_1 ,patients_disease_forms ,disease_forms
				where patients_disease_forms.question_id  = disease_1.questions_id
				AND patients_disease_forms.patient_id = patients.patient_id
				AND patients.person_id = persons.person_id
				AND patients.person_id = '.$ID.'
                AND disease_forms.question_id = patients_disease_forms.question_id
				AND disease_forms.disease_type_id =  1 ');

        if( count($person) > 0 ){
            $this->addTreeIDInfectedList($ID);
        }else{

        }
    }
    public function addTreeIDList($ID){
        $this->TreeIDList[] = $ID;
    }
    public function addTreeIDInfectedList($ID){
        $this->TreeIDInfectedList[] = $ID;
    }

    public function setPersonalInfo($person_array, $key)
    {
        $r = DB::table('persons')->where('person_id', '=', $key)->first();


        $person_array['key'] = $r->person_id;
        $person_array['n'] = $r->person_first_name.' '.$r->person_last_name.' '.$r->person_age.' y';
        $person_array['s'] = $this->convertSex_Language($r->person_sex);
        $person_array['a'][] = $this->convertAlive_Language($r->person_alive);

        // find Parent
        $person_array =  $this->find_parent($person_array , $r );
        // find Spouse
        $person_array = $this->find_spouse($person_array , $r );
        // add child
        $this->find_children($r );
        //print_r($this->TreeIDList);
        return $person_array;
    }

    public function convertAlive_Language($alive)
    {
        if ($alive == "1") {
            return '';
        } else {
            return "S";
        }

    }
    public function convertSex_Language($sex)
    {
        if ($sex == "male") {
            return "M";
        } else if ($sex == "female") {
            return "F";
        } else {
            return "N";
        }
    }

    public function find_spouse($person_array, $r)
    {

        //find_married
        $relation_married = DB::table('relationship')
            ->where('person_1_id', '=', $r->person_id)
            ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
            ->where('relationship_type_description', '=', "คู่สมรส")
            ->first();

        if (count($relation_married) != 0) {
            //$role= DB::table('roles')->where('role_id', '=', $relation_married->role_2_id)->first();
            $person_2 = DB::table('persons')
                ->where('person_id', '=', $relation_married->person_2_id)
                ->first();
            $this->addTOList( $person_2->person_id);

            $person_array['ux'] =$person_2->person_id;
            return $person_array;
        }

        $relation_married = DB::table('relationship')
            ->where('person_2_id', '=', $r->person_id)
            ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
            ->where('relationship_type_description', '=', "คู่สมรส")
            ->first();

        if (count($relation_married) != 0) {
            //$role= DB::table('roles')->where('role_id', '=', $relation_married->role_2_id)->first();
            $person_1 = DB::table('persons')
                ->where('person_id', '=', $relation_married->person_1_id)
                ->first();
            $this->addTOList(  $person_1->person_id);

            $person_array['ux'] =$person_1->person_id;
            return $person_array;

        } else {
            $person_array['ux']="";
            return $person_array;
        }
    }

    public function find_parent($person_array , $r)
    {

    //    $relation_parent_array = array();
        $relation_parent = DB::table('relationship')
            ->where('person_1_id', '=', $r->person_id)
            ->orWhere('person_2_id', '=', $r->person_id)
            ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
            ->where('relationship_type_description', '=', "พ่อเเม่ลูก")
            ->get();
        if (count($relation_parent) != 0 && $relation_parent != null) {
            //$rp_array =array();
            // find  dad
            foreach ($relation_parent as $rp) {
                if ($rp->person_2_id != $r->person_id) { // skip himself
                    $role_dad = DB::table('roles')
                        ->where('role_id', '=', $rp->role_2_id)
                        ->where('role_description', '=', "พ่อ")
                        ->first();
                    if (count($role_dad) != 0 && $role_dad != null) {
                        $person_dad = DB::table('persons')
                            ->where('person_id', '=', $rp->person_2_id)
                           ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;
                        if (count($person_dad) != 0) {
                             // add dad to list
                            $this->addTOList( $person_dad->person_id);
                            $person_array['m'] = $person_dad->person_id;
                            //$rp_array['role']=$role_dad->role_description;
                        }
                    }
                }
                if ($rp->person_1_id != $r->person_id) {
                    $role_dad = DB::table('roles')
                        ->where('role_id', '=', $rp->role_1_id)
                        ->where('role_description', '=', "พ่อ")
                        ->first();
                    if (count($role_dad) != 0 && $role_dad != null) {
                        $person_dad = DB::table('persons')
                            ->where('person_id', '=', $rp->person_1_id)

                            ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;
                        if (count($person_dad) != 0) {
                           // add dad to list
                            $this->addTOList( $person_dad->person_id);
                            $person_array['m'] = $person_dad->person_id;
                        }
                    }
                }

                // find mom
               if ($rp->person_2_id != $r->person_id ) {
                    $role_mom = DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                        ->where('role_description', '=', "เเม่")
                        ->first();
                    if (count($role_mom) != 0 && $role_mom != null) {
                        $person_mom = DB::table('persons')
                            ->where('person_id', '=', $rp->person_2_id)

                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;
                        if (count($person_mom) != 0) {
                             // add mom to list
                            $this->addTOList( $person_mom->person_id);
                            $person_array['f'] = $person_mom->person_id;
                            //$rp_array['role']=$role_mom->role_description;
                        }
                    }
                }
                if ($rp->person_1_id != $r->person_id) {
                    $role_mom = DB::table('roles')->where('role_id', '=', $rp->role_1_id)
                        ->where('role_description', '=', "เเม่")
                        ->first();
                    if (count($role_mom) != 0 && $role_mom != null) {
                        $person_mom = DB::table('persons')
                            ->where('person_id', '=', $rp->person_1_id)

                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;
                        if (count($person_mom) != 0) {
                             // add mom to list
                            $this->addTOList( $person_mom->person_id);
                            $person_array['f'] = $person_mom->person_id;
                            //$rp_array['role']=$role_mom->role_description;
                        }

                    }
                }

                //array_push($relation_parent_array, $rp_array);

            }

            return $person_array;
        } else {
            $person_array['m']="";
            $person_array['f']="";
            return $person_array;
        }
    }


    public function find_children($r, $id = null)
    {
        if ($id == null) {
            $local_id = $r->person_id;
        } else {
            $local_id = $id;
        }
        $relation_child_array = array();
        $relation_parent = DB::table('relationship')
            ->where('person_1_id', '=', $local_id)
            ->orWhere('person_2_id', '=', $local_id)
            ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
            ->where('relationship_type_description', '=', "พ่อเเม่ลูก")
            ->get();
        if (count($relation_parent) != 0) {

            //$rp_array =array();
            // find  ลูกชาย
            foreach ($relation_parent as $rp) {

                if ($rp->person_2_id != $local_id) {
                    $role_son = DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                        ->where('role_description', '=', "ลูกชาย")
                        ->first();
                    if (count($role_son) != 0) {
                        $person_son = DB::table('persons')
                            ->where('person_id', '=', $rp->person_2_id)

                            ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;
                        $this->addTOList($person_son->person_id);
                        //$relation_child_array[] = $person_son->person_id;
                        //$rp_array['role']=$role_dad->role_description;
                    }
                }


                if ($rp->person_1_id != $local_id) {


                    $role_son = DB::table('roles')->where('role_id', '=', $rp->role_1_id)
                        ->where('role_description', '=', "ลูกชาย")
                        ->first();
                    if (count($role_son) != 0) {
                        $person_son = DB::table('persons')
                            ->where('person_id', '=', $rp->person_1_id)

                            ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;
                        $this->addTOList($person_son->person_id);
                        //$relation_child_array[] = $person_son->person_id;
                        //$rp_array['role']=$role_dad->role_description;
                    }
                }

                // f
                //หา ลูกสาว

               if ($rp->person_2_id != $local_id) {

                    $role_daughter = DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                        ->where('role_description', '=', "ลูกสาว")
                        ->first();
                    if (count($role_daughter) != 0) {
                        $person_daughter = DB::table('persons')
                            ->where('person_id', '=', $rp->person_2_id)

                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;

                        $this->addTOList($person_daughter->person_id);

                       // $relation_child_array[] = $person_daughter->person_id;
                        //$rp_array['role']=$role_mom->role_description;

                    }
                }


                if ($rp->person_1_id != $local_id) {
                    $role_daughter = DB::table('roles')->where('role_id', '=', $rp->role_1_id)
                        ->where('role_description', '=', "ลูกสาว")
                        ->first();

                    if (count($role_daughter) != 0) {
                        $person_daughter = DB::table('persons')
                            ->where('person_id', '=', $rp->person_1_id)

                            ->first();

                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;
                         $this->addTOList($person_daughter->person_id);
                      //  $relation_child_array[] = $person_daughter->person_id;
                        //$rp_array['role']=$role_mom->role_description;

                    }
                }
                //array_push($relation_parent_array, $rp_array);

            }

           // return $relation_child_array;
        } else {
          //  return false;
        }
    }

    public function addTOList($key){
        if ((!$this->check_key_has_exists_valueByGeneralTree($this->data, 'key', $key)) && $key != null) {
            if (!in_array($key, $this->TreeIDList)) {
                $this->TreeIDList[] = $key;
            }

        }else{
          //  echo  $key . " Matched";
        }
    }


}