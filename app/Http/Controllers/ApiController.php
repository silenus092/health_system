<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use DB ;
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
    public function show_tree($id)
    {
        try{
            $result = array();
            $r =DB::table('persons')->where('person_citizenID', '=', $id)->first();
            if ( count($r) == 0 )
            {
                $result['Info']['status'] = "Error";
                $result['Info']['message'] = "No Person Found.";

                return response()->json($result, 200);
            }
            $result['Info']['status'] = "Success";
            $result['Info']['message'] = "";
            $result['person']['id']  = $r->person_id;
            $result['person']['title']['first_name']  = $r->person_first_name;
            $result['person']['title']['last_name'] = $r->person_last_name;
            $result['person']['description']['sex']  = $r->person_sex;
            $result['person']['description']['birth_date']  = $r->person_birth_date;
            $result['person']['description']['age']  = $r->person_age;
            $result['person']['description']['citizen_id']  = $r->person_citizenID;
            $result['person']['description']['house_num']  = $r->person_house_num;
            $result['person']['description']['mooh_num']  = $r->person_mooh_num;
            $result['person']['description']['soi']  = $r->person_soi;
            $result['person']['description']['road']  = $r->person_road;
            $result['person']['description']['tumbon']  = $r->person_tumbon;
            $result['person']['description']['amphur']  = $r->person_amphur;
            $result['person']['description']['province']  = $r->person_province;
            $result['person']['description']['post_code']  = $r->person_post_code;
            $result['person']['description']['phone']  = $r->person_phone;
            $result['person']['description']['mobile_phone']  = $r->person_mobile_phone;
            $result['person']['image']  = "";
            if($r->person_sex == "female"){
                $result['person']['itemTitleColor'] = "pink";
            }else{
                $result['person']['itemTitleColor'] = "";
            }
            $result['person']['groupTitle'] = "";
            $result['person']['groupTitlecolor'] = "";
            $relation_parent_array = array();
            // check parents for this guys
            $relation_parent = DB::table('relationship')
                ->where('person_1_id', '=', $r->person_id)
                ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
                ->where('relationship_type_description', '=', "พ่อเเม่")
                ->get();
            if(count($relation_parent) != 0 ){

                    $rp_array =array();
                     // find  dad
                    foreach ($relation_parent as $rp) {
                        $role_dad= DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                                                 ->where('role_description', '=', "พ่อ")
                                                 ->first();
                        if(count($role_dad) != 0){
                            $person_dad = DB::table('persons')
                                ->where('person_id', '=', $rp->person_2_id)
                                ->first();
                            $rp_array['first_name'] = $person_dad->person_first_name;
                            $rp_array['last_name'] = $person_dad->person_last_name;
                            $rp_array['role']=$role_dad->role_description;
                        }
                        // find mom
                        $role_mom= DB::table('roles')->where('role_id', '=', $rp->role_2_id)
                                                 ->where('role_description', '=', "เเม่")
                                                 ->first();
                        if(count($role_mom) != 0){
                            $person_mom = DB::table('persons')
                                ->where('person_id', '=', $rp->person_2_id)
                                ->first();
                            $rp_array['first_name'] = $person_mom->person_first_name;
                            $rp_array['last_name'] = $person_mom->person_last_name;
                            $rp_array['role']=$role_mom->role_description;

                        }
                            array_push($relation_parent_array, $rp_array);
                    }
                    $result['person']['parents'] =$relation_parent_array;
                }else{
                    $result['person']['parents'] ="";
            }
            //find_married
            $relation_married = DB::table('relationship')
                ->where('person_1_id', '=', $r->person_id)
                ->join('relationship_type', 'relationship.relationship_type_id', '=', 'relationship_type.relationship_type_id')
                ->where('relationship_type_description', '=', "คู่สมรส")
                ->first();
            if(count($relation_married) != 0 ){
                $role= DB::table('roles')->where('role_id', '=', $relation_married->role_2_id)->first();
                $person_2 = DB::table('persons')
                    ->where('person_id', '=', $relation_married->person_2_id)
                    ->first();
                $result['person']['spouses']['first_name'] = $person_2->person_first_name;
                $result['person']['spouses']['last_name'] = $person_2->person_last_name;
                $result['person']['spouses']['role']=$role->role_description;
            }else{
                $result['person']['spouses'] = "";
            }
            return response()->json($result, 200);
        }catch(Exception $e) {
            $result['Info']['status'] = "Error";
            $result['Info']['message'] = "$e";
            return response()->json($result, 200);
        }
    }
    
}
?>