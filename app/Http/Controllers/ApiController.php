<?php


namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Response;
use Input;

class ApiController extends Controller

{
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    private $list = array();

    private $this_db;

    /**
     * Initializer.
     *
     * @return void
     */
    public function __construct()
    {
        // CSRF Protection

    }


    public function show_tree($id)
    {
        try {
            // check this guy exist or not
            $result = array();
            $r = DB::table('persons')->where('person_id', '=', $id)
                ->where('deleted_flag', '=', false)
                ->first();
            if (count($r) == 0) {
                $result['Info']['status'] = "Complete";
                $result['Info']['message'] = "No Person Found";

                return response()->json($result, 200);
            }
            $result['Info']['status'] = "Complete";
            $result['Info']['message'] = "Found";

            if (\Session::has('focused_id')) {
                \Session::set('focused_id', $id);
            } else {
                \Session::put('focused_id', $id);
            }


            $this->list[] = $r->person_id;

            // Let's fill personal information to id array list.
            $result = $this->adjustArrayForTree($result, 10);
            //$result = $this->remove_NonRelevance($result, $id);
            //$result = $this->sortTree($result);
            return response()->json($result, 200);
        } catch (Exception $e) {
            $result['status'] = "Error";
            $result['message'] = $e;
            return response()->json($result, 200);
        }
    }

    public function adjustArrayForTree($result = null, $local_depth = null)
    {
        if ($local_depth != null && $result != null) {

            while (count($this->list) > 0 && $local_depth > 0) {
                //$this->list = array_filter($this->list);
                $size = count($this->list);
                //echo "Round ".$local_depth ;
                //var_dump($this->list);
                for ($i = 0; $i < $size; $i++) {
                    $id = array_shift($this->list);
                    if ((!$this->check_key_has_exists_value($result, 'id', $id)) && $id != null) {
                        // add another personal info
                        $r = DB::table('persons')->where('person_id', '=', $id)->where('deleted_flag', '=', false)->first();

                        if (count($r) > 0) {
                            $person_array = array();
                            $person_array = $this->set_personal_info_to_tree($person_array, $r);

                            // Find his/her parent
                            $parents = $this->find_parent($r);
                            if (count($parents) >= 1 && $parents != null) {
                                $person_array['parents'] = $parents;
                            }
                            //  echo "Found parents ".$local_depth ;
                            // var_dump($this->list);

                            // Find his/her spouse
                            $spouses = $this->find_spouse($result, $r);
                            if ($spouses != null && count($spouses) >= 1) {
                                $person_array['spouses'][] = $spouses;
                            }
                            //  echo "Found spouse ".$local_depth ;
                            // var_dump($this->list);

                            // find their relatives
                            $this->find_relatives($result, $r);

                            // หาลูกตัวเอง
                            $this->find_children($r);
                            //  echo "Found kids ".$local_depth ;
                            // var_dump($this->list);

                            // store it into array
                            if ($person_array['id'] != null) {
                                $result['person'][] = $person_array;
                            }

                            // finish this person , remove it so we will not serach for this person again

                            //$this->list[$i] = null;

                            //unset($this->list[$i]);
                        }

                    }
                    //array_shift($this->list);
                }


                //echo "After Round ".$local_depth ;
                //var_dump($this->list);
                $local_depth--;
            }

            return $result;
        } else { // use for deletion
            $id = array_shift($this->list);
            $r = DB::table('persons')->where('person_id', '=', $id)->where('deleted_flag', '=', false)->first();
            DB::table('persons')
                ->where('person_id', $id)
                ->update(array('deleted_flag' => TRUE));
            // หาลูกตัวเองd
            $this->find_children($r);
            // Find his/her parent
            $this->find_spouse($result, $r);

            while (count($this->list) > 0) {

                $id = array_shift($this->list);
                // add another personal info
                $r = DB::table('persons')->where('person_id', '=', $id)->where('deleted_flag', '=', false)->first();

                if (count($r) > 0) {
                    // Find his/her parent
                    $this->find_parent($r);
                    // Find his/her spouse
                    $this->find_spouse($result, $r);

                    // find their relatives
                    $this->find_relatves($result, $r);

                    // หาลูกตัวเอง
                    $this->find_children($r);


                    DB::table('persons')
                        ->where('person_id', $id)
                        ->update(array('deleted_flag' => TRUE));
                }

            }
            return 1;
        }

    }

    public function set_personal_info_to_tree($person_array, $r)
    {

        $person_array['id'] = $r->person_id;
        $person_array['id_key'] = $r->person_id;
        $person_array['first_name'] = $r->person_first_name;
        $person_array['last_name'] = $r->person_last_name;
        $person_array['sex'] = $r->person_sex;
        $person_array['age'] = $r->person_age;
        $person_array['person_alive'] = $r->person_alive;
        $person_array['title'] = $r->person_first_name . " " . $r->person_last_name;
        $person_array['description'] = "เพศ: " . $this->convertSex_Language($r->person_sex) . " อายุ: " . $r->person_age;
        $person_array['templateName'] = "contactTemplate";
        if ($r->profile_img != null) {
            $person_array['image'] = url() . '/get_images/' . $r->profile_img;
        } else {
            $person_array['image'] = null;
        }

        $date_temp = explode("-", $r->person_birth_date);

        $person_array['year'] = (int)$date_temp[0];
        $person_array['month'] = (int)$date_temp[1];
        $person_array['day'] = (int)$date_temp[2];
        $pink = $this->check_female($r->person_sex);
        if ($pink != null) {
            $person_array['itemTitleColor'] = $pink;
        }

        if (count(DB::table('patients')->where('person_id', '=', $r->person_id)->first()) > 0) {
            $person_array['groupTitle'] = "ผู้ป่วย";
            $person_array['groupTitleColor'] = "orange";
            $person_array['is_sick'] = "sick";
        } else {
            $person_array['groupTitle'] = "ปกติ";
            $person_array['groupTitleColor'] = null;
            $person_array['is_sick'] = "un_sick";
        }

        return $person_array;
    }

    public function convertSex_Language($sex)
    {

        if ($sex == "male") {
            return "ชาย";
        } else if ($sex == "female") {
            return "หญิง";
        } else {
            return "ระบุไม่ได้";
        }

    }

    public function check_female($sex)
    {
        if ($sex == "female") {
            return "pink";
        } else {
            return null;
        }

    }

    public function find_parent($r)
    {
        $relation_parent_array = array();
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
                            ->where('deleted_flag', '=', false)->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;
                        if (count($person_dad) != 0) {
                            $this->list[] = $person_dad->person_id; // add dad to list
                            $relation_parent_array[] = $person_dad->person_id;
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
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;

                        if (count($person_dad) != 0) {
                            $this->list[] = $person_dad->person_id; // add dad to list
                            $relation_parent_array[] = $person_dad->person_id;

                        }
                    }
                }

                // find mom

                if ($rp->person_2_id != $r->person_id) {

                    $role_mom = DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                        ->where('role_description', '=', "เเม่")
                        ->first();
                    if (count($role_mom) != 0 && $role_mom != null) {
                        $person_mom = DB::table('persons')
                            ->where('person_id', '=', $rp->person_2_id)
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;
                        if (count($person_mom) != 0) {
                            $this->list[] = $person_mom->person_id; // add mom to list

                            $relation_parent_array[] = $person_mom->person_id;
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
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;

                        if (count($person_mom) != 0) {
                            $this->list[] = $person_mom->person_id; // add mom to list

                            $relation_parent_array[] = $person_mom->person_id;
                            //$rp_array['role']=$role_mom->role_description;
                        }

                    }
                }
                //array_push($relation_parent_array, $rp_array);

            }

            return $relation_parent_array;
        } else {
            return false;
        }
    }

    public function find_spouse($result, $r)
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
                ->where('deleted_flag', '=', false)->first();
            $this->list[] = $person_2->person_id;
            return $person_2->person_id;

        }
        $relation_married = DB::table('relationship')
            ->where('person_2_id', '=', $r->person_id)
            ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
            ->where('relationship_type_description', '=', "คู่สมรส")
            ->first();
        if (count($relation_married) != 0) {
            //$role= DB::table('roles')->where('role_id', '=', $relation_married->role_2_id)->first();
            $person_2 = DB::table('persons')
                ->where('person_id', '=', $relation_married->person_1_id)
                ->where('deleted_flag', '=', false)->first();
            $this->list[] = $person_2->person_id;
            return $person_2->person_id;

        } else {
            return null;
        }

    }

    public function find_relatives($result = null, $r)
    {
        $relation_relatives = DB::table('relationship')
            ->where('person_1_id', '=', $r->person_id)
            ->orWhere('person_2_id', '=', $r->person_id)
            ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
            ->where('relationship_type_description', '=', "พี่น้อง")
            ->get();
        if (count($relation_relatives) != 0) {
            foreach ($relation_relatives as $rr) {
                $person_2 = DB::table('persons')
                    ->where('person_id', '=', $rr->person_2_id)
                    ->where('deleted_flag', '=', false)->first();
                if ($result != null && !$this->check_key_has_exists_value($result, 'id', $person_2->person_id) && !in_array($person_2->person_id, $this->list)) {
                    $this->list[] = $person_2->person_id;
                }

                $person_1 = DB::table('persons')
                    ->where('person_id', '=', $rr->person_1_id)->
                    where('deleted_flag', '=', false)->first();
                if ($result != null && !$this->check_key_has_exists_value($result, 'id', $person_1->person_id) && !in_array($person_1->person_id, $this->list)) {
                    $this->list[] = $person_1->person_id;
                }
            }
            return true;
        } else {
            return false;
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
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;

                        $this->list[] = $person_son->person_id; // add dad to list

                        $relation_child_array[] = $person_son->person_id;
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
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_dad->person_first_name." ".$person_dad->person_last_name;

                        $this->list[] = $person_son->person_id; // add dad to list

                        $relation_child_array[] = $person_son->person_id;
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
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;

                        $this->list[] = $person_daughter->person_id; // add mom to list

                        $relation_child_array[] = $person_daughter->person_id;
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
                            ->where('deleted_flag', '=', false)
                            ->first();
                        //$rp_array['title'] = $person_mom->person_first_name." ".$person_mom->person_last_name;

                        $this->list[] = $person_daughter->person_id; // add mom to list

                        $relation_child_array[] = $person_daughter->person_id;
                        //$rp_array['role']=$role_mom->role_description;

                    }
                }
                //array_push($relation_parent_array, $rp_array);

            }

            return $relation_child_array;
        } else {
            return false;
        }
    }

    public function sortTree($array_tree)
    {
        $array_tree_local = $array_tree;
        $array_size = sizeof($array_tree_local['person']);
        $counter = 0;
        //var_dump($array_tree_local['person'][2]['parents']);
        //echo  $array_tree_local['person'][0]['id'];
        foreach ($array_tree_local['person'] as $item) {

            //print_r(count($haveChild));
            if ($item['parents'] != null && ($item['parents'][0] != null || $item['parents'][1] != null)) {
                $relative_array = array();

                //searching through

                for ($i = 0; $i < $array_size; $i++) {
                    // Found same parent
                    // echo  "id ".$array_tree_local['person'][$i]['id']. "\n";
                    //$haveChild = $this->find_children($array_tree_local['person'][$i]);

                    // print_r($haveParent);
                    if ($array_tree_local['person'][$i]['parents'][0] != null && count(array_diff($item['parents'], $array_tree_local['person'][$i]['parents'])) == 0) {
                        $relative_array[] = $array_tree_local['person'][$i];
                    }
                }


                //Sort by age for relative in same family (Ascending order)

                $age = array();
                foreach ($relative_array as $key => $row) {
                    $age[$key] = $row['age'];
                }
                array_multisort($age, SORT_DESC, $relative_array);


                //reassign value to temp_id
                // add  count to  ascii   code  each round  ex. A = 44 B =45
                $chr_group = chr(97 + $counter);
                for ($k = 0; $k < sizeof($relative_array); $k++) {
                    if (sizeof($relative_array) - 1 == $k) {
                        $relative_array[$k]['id'] = $chr_group . "1";
                    } else {
                        $relative_array[$k]['id'] = $chr_group . ($k + 2);
                    }
                }

                //assign back to original

                for ($i = 0; $i < sizeof($relative_array); $i++) {
                    // Found same parent
                    for ($j = 0; $j < sizeof($array_tree_local['person']); $j++) {
                        if ($array_tree_local['person'][$j]['id_key'] == $relative_array[$i]['id_key']) {
                            $array_tree_local['person'][$j]['id'] = $relative_array[$i]['id'];

                        }
                    }
                }


                //reupdate ID with other ralation check parent id and id_key aif match reupdate it

                for ($i = 0; $i < sizeof($relative_array); $i++) {
                    // Found same parent

                    for ($j = 0; $j < sizeof($array_tree_local['person']); $j++) {
                        if ($array_tree_local['person'][$j]['parents'][0] != null && $array_tree_local['person'][$j]['parents'][0] == $relative_array[$i]['id_key']) {
                            $array_tree_local['person'][$j]['parents'][0] = $relative_array[$i]['id'];

                        }
                        if ($array_tree_local['person'][$j]['parents'][1] != null && $array_tree_local['person'][$j]['parents'][1] == $relative_array[$i]['id_key']) {
                            $array_tree_local['person'][$j]['parents'][1] = $relative_array[$i]['id'];

                        }

                        if ($array_tree_local['person'][$j]['spouses'] != null && $array_tree_local['person'][$j]['spouses'][0] == $relative_array[$i]['id_key']) {
                            $array_tree_local['person'][$j]['spouses'][0] = $relative_array[$i]['id'];
                        }
                    }
                }

                $counter++;
            }

            //echo  "-------------------------------------------------\n";
            //var_dump($array_tree_local);
        }

        return $array_tree_local;
    }

    // กรณีที่ตัวเองเป็นลูก

    public function find_IsSick($id)
    {
        $patient = DB::table('patients')->where('person_id', '=', $id)->first();
        if (count($patient) > 0) {
            return "orange";
        }
        return null;
    }

    // กรณีที่ตัวเองเป็นพ่อหรือเเม่

    /**
     * Add new person
     */

    public function add_person()
    {
        try {
            DB::beginTransaction();
            $obj = json_decode(Input::get('inputs'));
            $IsSick = $obj->is_sick;
            $person_sex = $obj->sex;

            $person_age = $obj->age;
            $person_birth_year = $obj->year;
            $person_birth_month = $obj->month;
            $person_birth_day = $obj->day;
            $person_birth_date = "";
            if ($person_age == "" || $person_age == null) {
                $person_age = $this->cal_age($person_birth_day, $person_birth_month, $person_birth_year);
            }
            if ($person_birth_day == null || $person_birth_day == "") {
                $person_birth_day = "1";
            }
            if ($person_birth_month == null || $person_birth_month == "") {
                $person_birth_month = "1";
            }
            if ($person_birth_year != null || $person_birth_year != "") {
                $person_birth_date = $person_birth_year . "-" . $person_birth_month . "-" . $person_birth_day;
            }
            $parents = $obj->parents_id;
            $spouse_id = $obj->spouse_id;
            $relatives = $obj->relatives_id;
            $sons = $obj->son_id;
            $type_of_relationship = $obj->type_of_relationship;
            /*if($obj->person_alive == "1"){
                $person_alive = "live" ;
            }else{
                $person_alive = "not live";
            }*/
            $Person_id = DB::table('persons')->insertGetId(['person_first_name' => $obj->first_name, 'person_last_name' => $obj->last_name,
                'person_alive' => $obj->person_alive,
                'person_birth_date' => $person_birth_date,
                'person_sex' => $person_sex, 'person_age' => $person_age]);

            if ($type_of_relationship == "parent") {
                $this->add_child($Person_id, $sons, $person_sex);
            } else if ($type_of_relationship == "spouse") {
                $this->add_spouse($Person_id, $spouse_id, $person_sex);
                $this->add_child($Person_id, $sons, $person_sex);
            } else if ($type_of_relationship == "relative") {

                $this->add_parent($Person_id, $parents, $person_sex);
                $relatives = $this->FindRelativesByParent($parents);
                $this->add_relative($Person_id, $relatives, $person_sex, $person_age);
            } else if ($type_of_relationship == "son") {
                $this->add_parent($Person_id, $parents, $person_sex);
                $relatives = $this->FindRelativesByParent($parents);
                $this->add_relative($Person_id, $relatives, $person_sex, $person_age);
            } else {
                DB::rollback();
                $result['status'] = "No relationship found ";
                $result['message'] = "please select relationship before submit.";
                return response()->json($result, 200);
            }

            // update relationship with other persons
            // this->update_relationship_with_other($parnets,$sons,$relatives,$spouses);

            //
            if ($IsSick == "sick") {
                $doctor_id = DB::table('doctors')->insertGetId(['doctor_name' => "ไม่ทราบ", 'doctor_mobile_phone' => "ไม่ทราบ",
                    'doctor_phone' => "ไม่ทราบ", 'hospital' => "ไม่ทราบ",
                    'email' => "ไม่ทราบ"]);

                DB::table('patients')->insert(['person_id' => $Person_id, 'doctor_id' => $doctor_id,
                    'registration_date' => date("Y-m-d")]);
            } else if ($IsSick == "un_sick") {

            }
            DB::commit();
            \Session::set('last_deleted_id', '');
            // check this guy exist or not
            /*	$result = array();
            $this->list =  array();
            $r =DB::table('persons')->where('person_id', '=', $Person_id)->first();
            if ( count($r) == 0 )
            {

                $result['Info']['status'] = "Complete";
                $result['Info']['message'] = "No Person Found";

                return response()->json($result, 200);
            }
            $result['Info']['status'] = "Complete";
            $result['Info']['message'] = "Found";
            // Fuck , this array  for persons
            $person_array =array();

            // Init for patient only
            $person_array['id']  = $r->person_id;
            $person_array['title'] = $r->person_first_name." ".$r->person_last_name;
            $person_array['description'] = "Sex: ".$r->person_sex." Age: ".$r->person_age;
            $pink = $this->check_female($r->person_sex);
            if($pink != null){
                $person_array['itemTitleColor']  = $pink;
            }
            //
            //	เดี่ยวต้อง เช็ค ว่าเป็นผู้ป่วยรึเปล่า ยังไม่ได้!!
            //
            $person_array['groupTitle'] ="ผู้ป่วย";
            $person_array['groupTitleColor'] = $this->find_IsSick($r->person_id);

            $parents = $this->find_parent($result,$r);
            if($parents != null){
                $person_array['parents']  = $parents;
            }
            $spouses  = $this->find_spouse($result,$r);
            if($spouses != null){
                $person_array['spouses'][] = $spouses;
            }
            $result['person'][] = $person_array;
            // หาพี่น้องตัวเองด้วย
            $this->find_relatives($result,$r);
            // หาลูกตัวเอง
            $this->find_children($r);

            // Let's fill personal information to id array list.
            $depth = 3 ;
            while(count($this->list) >0 && $depth > 0 ){

                $size = count($this->list);
                for( $i=0 ; $i < $size ; $i++){
                    if(isset($this->list[$i]) && !$this->check_key_has_exists_value($result,'id',$this->list[$i]) ){
                        $r = DB::table('persons')->where('person_id', '=', $this->list[$i])->first();

                        $person_array =array();
                        $person_array  = $this->set_personal_info_to_tree($person_array , $r);

                        // Find his/her parent
                        $parents = $this->find_parent($result,$r);
                        if($parents != null){
                            $person_array['parents']  = $parents;
                        }

                        // Find his/her spouse
                        $spouses  = $this->find_spouse($result,$r);
                        if($spouses != null){
                            $person_array['spouses'][] = $spouses;
                        }

                        $this->find_relatives($result,$r);
                        // หาลูกตัวเอง
                        $this->find_children($r);
                        // store it into array
                        $result['person'][] = $person_array;
                        // finish this person , remove it so we will not serach for this person again

                        //$this->list[$i] = null;

                        unset($this->list[$i]);
                    }

                }

                $depth--;
            }
            return response()->json($result, 200);*/
            $result['status'] = "success";
            $result['message'] = "New data added :" . $Person_id;
            return response()->json($result, 200);
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }

    //กรณีที่ตัวเองเป็นสามี หรือ ภรรยา

    public function cal_age($day = 0, $month = 0, $year)
    {
        $curYear = date("Y");
        $curMonth = date("m");
        $curDay = date("j");
        $curYear = (int)$curYear + 543;
        $age = $curYear - (int)$year;

        if ($curMonth < $month || ($curMonth == $month && $curDay < $day))
            $age--;
        return $age;
    }

    public function add_child($my_id, $children, $my_sex)
    {
        $role1 = 21;
        $role2 = 21;
        if (!count($children) > 0) {
            return false;
        }
        if ($my_sex == "male") {
            $role1 = 1;

        } else if ($my_sex == "female") {
            $role1 = 2;

        } else {
            $role1 = 21;

        }
        foreach ($children as $children_id) {
            $children_obj = DB::table('persons')->where('person_id', '=', $children_id)->first();
            if ($children_obj->person_sex == "male") {
                $role2 = 19;
            } else if ($children_obj->person_sex == "female") {
                $role2 = 20;
            } else {
                $role2 = 21;
            }
            $relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
                'relationship_type_id' => 3, 'person_2_id' => $children_obj->person_id, 'role_2_id' => $role2]);
        }

    }

    public function add_spouse($my_id, $spouses, $my_sex)
    {
        $role1 = 21;
        $role2 = 21;
        if ($spouses == null) {
            return false;
        }
        if ($my_sex == "male") {
            $role1 = 23;
            $role2 = 22;
        } else if ($my_sex == "female") {
            $role1 = 22;
            $role2 = 23;
        } else {
            $role1 = 21;
            $role2 = 21;
        }
        foreach ($spouses as $spouse_id) {
            $relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
                'relationship_type_id' => 4, 'person_2_id' => $spouse_id, 'role_2_id' => $role2]);
        }
    }

    /*public function update_relationship_with_other($parnets,$sons,$relatives,$spouses){

        if(count($parnets)>0){
            foreach($parnets as $parent_id){
                // get all persons tht have relative with dad
                $person_1 = DB::table('relationship')
                    ->where('person_1_id', '=', $r->person_id)
                    ->get();

                if(count($person_1)>0){

                        foreach($person_1 as  $person){

                        }
                }

                }
            }
        }




        if(count($sons)>0){
            foreach(){

            }
        }
        if(count($relatives)>0){
            foreach(){

            }
        }
        if(count($spouses)>0){
            foreach(){

            }
        }
    }

    // update ญาติที่อยู่ฝั่งพ่อ
    public function update_relationship_dad_relative($dad_id){
        $parent_obj = DB::table('persons')->where('person_', '=',$childen_id)->first();
    }
    // update ญาติที่อยู่ฝั่งเเม่

    // update ญาติที่อยู่ฝั่งสามี

    // update ญาติที่อยู่ฝั่งภรรยา

    // update หลาน

    // update ลูก
    */

    public function add_parent($my_id, $parnets, $my_sex)
    {
        $role1 = 21;
        $role2 = 21;
        if (!count($parnets) > 0) {
            return false;
        }
        if ($my_sex == "male") {
            $role1 = 19;
        } else if ($my_sex == "female") {
            $role1 = 20;
        } else {
            $role1 = 21;
        }

        foreach ($parnets as $parent_id) {
            $parent_obj = DB::table('persons')->where('person_id', '=', $parent_id)->first();
            if ($parent_obj->person_sex == "male") {
                $role2 = 1;
            } else if ($parent_obj->person_sex == "female") {
                $role2 = 2;
            } else {
                $role2 = 21;
            }
            $relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
                'relationship_type_id' => 3, 'person_2_id' => $parent_id, 'role_2_id' => $role2]);
        }

    }

    //ผิดตรงนนี้เเหละ มการเกิม parent เป็นพี่น้อง
    public function FindRelativesByParent($Parents)
    {
        $relatives = array();
        foreach ($Parents as $parent_id) {
            $person_1_id = DB::table('relationship')
                ->where('person_1_id', '=', $parent_id)
                ->where('role_1_id', '=', 19)->orWhere('role_1_id', '=', 20)
                ->get();
            foreach ($person_1_id as $p1) {
                if (!in_array($p1->person_1_id, $relatives)) {
                    $relatives[] = $p1->person_1_id;
                }
            }
            $person_2_id = DB::table('relationship')
                ->where('person_2_id', '=', $parent_id)
                ->where('role_2_id', '=', 19)->orWhere('role_2_id', '=', 20)
                ->get();
            foreach ($person_2_id as $p2) {
                if (!in_array($p2->person_2_id, $relatives)) {
                    $relatives[] = $p2->person_2_id;
                }
            }

        }
        return $relatives;
    }

    public function add_relative($my_id, $relatives, $my_sex, $my_age)
    {
        $role1 = 21;
        $role2 = 21;
        if (count($relatives) <= 0) {
            return false;
        } else {
            foreach ($relatives as $relatives_id) {

                if ($my_id != $relatives_id) {
                    $relative = DB::table('persons')->where('person_id', '=', $relatives_id)->first();
                    if ($my_age > $relative->person_age) {
                        if ($my_sex == "male") {
                            $role1 = 3;

                        } else if ($my_sex == "female") {
                            $role1 = 4;
                        } else {
                            $role1 = 21;

                        }
                        if ($relative->person_sex == "male") {
                            $role2 = 5;
                        } else if ($relative->person_sex == "female") {
                            $role2 = 6;
                        } else {
                            $role2 = 21;
                        }
                    } else { // If they have the same age , fall in this case
                        if ($my_sex == "male") {
                            $role1 = 5;

                        } else if ($my_sex == "female") {
                            $role1 = 6;

                        } else {
                            $role1 = 21;

                        }
                        if ($relative->person_sex == "male") {
                            $role2 = 3;
                        } else if ($relative->person_sex == "female") {
                            $role2 = 4;
                        } else {
                            $role2 = 21;
                        }
                    }
                    $relationship = DB::table('relationship')->insert(['person_1_id' => $my_id, 'role_1_id' => $role1,
                        'relationship_type_id' => 2, 'person_2_id' => $relative->person_id, 'role_2_id' => $role2]);
                }

            }
        }

    }

    public function edit_person()
    {
        try {
            $obj = json_decode(Input::get('inputs'));
            $person_sex = $obj->sex;
            $person_age = $obj->age;
            $person_birth_year = $obj->year;
            $person_birth_month = $obj->month;
            $person_birth_day = $obj->day;
            $person_birth_date = "";
            $person_id = $obj->person_change_id;
            $relationship_with_person_id = $obj->person_id;
            $IsSick = $obj->is_sick;
            $parents = $obj->parents_id;
            $spouse_id = $obj->spouse_id;
            $relatives = $obj->relatives_id;
            $sons = $obj->son_id;
            $type_of_relationship = $obj->type_of_relationship;
            $persons = DB::table('persons')->where('person_id', '=', $person_id)->first();
            if (count($persons) == 0) {
                $result['status'] = "Error";
                $result['message'] = "Person not found";
                return response()->json($result, 200);
            }
            DB::beginTransaction();
            /*	if($obj->person_alive == "1"){
                    $person_alive = "live" ;
                }else{
                    $person_alive = "not live";
                }*/
            if ($person_age == "" || $person_age == null) {
                $person_age = $this->cal_age($person_birth_day, $person_birth_month, $person_birth_year);
            }
            if ($person_birth_day == null || $person_birth_day == "") {
                $person_birth_day = "1";
            }
            if ($person_birth_month == null || $person_birth_month == "") {
                $person_birth_month = "1";
            }
            if ($person_birth_year != null || $person_birth_year != "") {
                $person_birth_date = $person_birth_year . "-" . $person_birth_month . "-" . $person_birth_day;
            }
            /*if($obj->person_alive == "1"){
                $person_alive = "live" ;
            }else{
                $person_alive = "not live";
            }*/

            DB::table('persons')
                ->where('person_id', $person_id)
                ->update(['person_first_name' => $obj->first_name,
                    'person_last_name' => $obj->last_name,
                    'person_alive' => $obj->person_alive, // $obj->person_alive == "1" live , p not live
                    'person_birth_date' => $person_birth_date,
                    'person_sex' => $person_sex,
                    'person_age' => $person_age
                ]);
            //  handling if sick or not
            $patient = DB::table('patients')->where('person_id', '=', $person_id)->first();
            if ($IsSick == "sick") {

                if (count($patient) > 0) {

                } else {

                    $doctor_id = DB::table('doctors')->insertGetId(['doctor_name' => "ไม่ทราบ", 'doctor_mobile_phone' => "ไม่ทราบ",
                        'doctor_phone' => "ไม่ทราบ", 'hospital' => "ไม่ทราบ",
                        'email' => "ไม่ทราบ"]);
                    DB::table('patients')->insert(['person_id' => $person_id, 'doctor_id' => $doctor_id,
                        'registration_date' => date("Y-m-d")]);
                }

            } else if ($IsSick == "un_sick") {
                if (count($patient) > 0) {
                    DB::table('patients')->where('person_id', '=', $person_id)->delete();
                    DB::table('doctors')->where('doctor_id', '=', $patient->doctor_id)->delete();
                } else {

                }


            }

            //  handling if relationship change  or not ,if not change  null represent otherwise
            if ($type_of_relationship != null || $type_of_relationship != "") {
                DB::table('relationship')->where('person_1_id', '=', $person_id)->delete();
                DB::table('relationship')->where('person_2_id', '=', $person_id)->delete();
                $person_2 = DB::table('persons')->where('person_id', '=', $relationship_with_person_id)->first();
                /*$thatperson[] =$person_2->person_id;
                if($type_of_relationship  == "parent"){
                    $this->add_child($person_id,$thatperson,$person_sex);
                }else if($type_of_relationship == "spouse"){
                    $this->add_spouse($person_id ,$thatperson,	$person_sex);
                    //$this->add_child($person_id,$sons,$person_sex);
                }else if($type_of_relationship == "relative"){

                    $this->add_parent($person_id ,$parents ,$person_sex);
                    $relatives =$this->FindRelativesByParent($parents);
                    $this->add_relative($person_id ,$thatperson ,$person_sex,$person_age);
                }else if($type_of_relationship == "son"){
                    $this->add_parent($person_id ,$thatperson ,$person_sex);
                    //$relatives =$this->FindRelativesByParent($parents);
                    //$this->add_relative($Person_id ,$relatives ,$person_sex,$person_age);
                }else{
                    DB::rollback();
                    $result['status'] = "No relationship found ";
                    $result['message'] = "please select relationship before submit.";
                    return response()->json($result, 200);
                }*/
                if ($type_of_relationship == "parent") {
                    $this->add_child($person_id, $sons, $person_sex);
                } else if ($type_of_relationship == "spouse") {
                    $this->add_spouse($person_id, $spouse_id, $person_sex);
                    $this->add_child($person_id, $sons, $person_sex);
                } else if ($type_of_relationship == "relative") {

                    $this->add_parent($person_id, $parents, $person_sex);
                    $relatives = $this->FindRelativesByParent($parents);
                    $this->add_relative($person_id, $relatives, $person_sex, $person_age);
                } else if ($type_of_relationship == "son") {
                    $this->add_parent($person_id, $parents, $person_sex);
                    $relatives = $this->FindRelativesByParent($parents);
                    $this->add_relative($person_id, $relatives, $person_sex, $person_age);
                } else {
                    DB::rollback();

                    $result['status'] = "No relationship found: " . $type_of_relationship;
                    $result['message'] = "please select appropriate relationship before submit.";
                    return response()->json($result, 200);
                }
            }

            DB::commit();
            \Session::set('last_deleted_id', '');
            $result['status'] = "Success";
            $result['message'] = "Update new Infomation complete";
            return response()->json($result, 200);

        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }
    }

    public function delete_person()
    {
        try {
            DB::beginTransaction();
            $Temp = json_decode(Input::get('inputs'));
            $id = $Temp->person_id;
            \Session::put('last_deleted_id', $id);
            // check this guy exist or not
            if ($id != "") {

                DB::table('persons')
                    ->where('person_id', $id)
                    ->update(array('deleted_flag' => TRUE));
                // $this->list[] =$id;
                // $this->adjustArrayForTree();

                /* old style
                $patient = DB::table('patients')->where('person_id', '=', $id)->first();
                 if (count($patient) > 0) {
                     $patients_disease_forms = DB::table('patients_disease_forms')
                         ->where('patient_id', '=', $patient->patient_id)->get();
                     if (count($patients_disease_forms) > 0) {
                         foreach ($patients_disease_forms as $pdf) {
                             DB::table('disease_1')->where('questions_id', '=', $pdf->question_id)->delete();
                         }
                         $patients_disease_forms->delete();
                     }
                     DB::table('patients')->where('person_id', '=', $id)->delete();
                     DB::table('doctors')->where('doctor_id', '=', $patient->doctor_id)->delete();
                 }
                 DB::table('relationship')->where('person_1_id', '=', $id)->delete();
                 DB::table('relationship')->where('person_2_id', '=', $id)->delete();
                 DB::table('persons')->where('person_id', '=', $id)->delete();*/
                DB::commit();
                $result['status'] = "Success";
                $result['message'] = "Good bye id:" . $id;
                return response()->json($result, 200);
            } else {
                $result['status'] = "Error";
                $result['message'] = "ID is null " . $id;
                return response()->json($result, 200);
            }

        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }

    }

    public function getToken()
    {
        return Response::json(['token' => csrf_token()]);
    }

    public function checkUndoState()
    {
        $id = \Session::get('last_deleted_id');

        // check this guy exist or not
        if ($id != "") {
            $result['status'] = "True";
            $result['message'] = "Can undo";
            return response()->json($result, 200);
        } else {
            $result['status'] = "False";
            $result['message'] = "Nothing to undo";
            return response()->json($result, 200);
        }
    }

    public function undoState()
    {
        try {
            DB::beginTransaction();
            //$Temp = json_decode(Input::get('inputs'));
            $id = \Session::get('last_deleted_id');

            // check this guy exist or not
            if ($id != "") {

                DB::table('persons')
                    ->where('person_id', $id)
                    ->update(array('deleted_flag' => false));
                /* $patient = DB::table('patients')->where('person_id', '=', $id)->first();
                 if (count($patient) > 0) {
                     $patients_disease_forms = DB::table('patients_disease_forms')
                         ->where('patient_id', '=', $patient->patient_id)->get();
                     if (count($patients_disease_forms) > 0) {
                         foreach ($patients_disease_forms as $pdf) {
                             DB::table('disease_1')->where('questions_id', '=', $pdf->question_id)->delete();
                         }
                         $patients_disease_forms->delete();
                     }
                     DB::table('patients')->where('person_id', '=', $id)->delete();
                     DB::table('doctors')->where('doctor_id', '=', $patient->doctor_id)->delete();
                 }
                 DB::table('relationship')->where('person_1_id', '=', $id)->delete();
                 DB::table('relationship')->where('person_2_id', '=', $id)->delete();
                 DB::table('persons')->where('person_id', '=', $id)->delete();*/
                DB::commit();
                \Session::set('last_deleted_id', '');
                $result['status'] = "Success";
                $result['message'] = "Undo delete id:" . $id;
                return response()->json($result, 200);
            } else {
                $result['status'] = "Nothing to undo";
                $result['message'] = "ID is null " . $id;
                return response()->json($result, 200);
            }
        } catch (Exception $e) {
            DB::rollback();
            $result['status'] = "Error";
            $result['message'] = $e->getMessage();
            return response()->json($result, 200);
        }

    }

    public function remove_NonRelevance($array_result, $main_id)
    {
        for ($i = 0; $i < sizeof($array_result); $i++) {

            }
    }
}

?>
