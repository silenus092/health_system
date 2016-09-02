<?php namespace App\Http\Controllers;

use DB;
use Input;

class DuchenneController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //จากจำนวนผู้ป่วยทั้งหมด มีกี่คนที่มีประวัติมีคนเป็นโรคแบบผู้ป่วยมาก่อนในครอบครัว และกี่คนที่ไม่มีประวัติมีคนเป็นแบบเดียวกันมาก่อน

        // ในรายที่ไม่มีประวัติมีคนเป็นแบบเดียวกันมาก่อนนั้น มารดาได้รับการตรวจพาะหะกี่ราย และผลพบเป็นพาหะกี่ราย ไม่เป็นพาหะกี่ราย

        // ผู้ป่วยมีพี่น้องเพศหญิงที่เกิดจากแม่เดียวกัน กี่คน

        // มารดาของผู้ป่วยมีพี่น้องเพศหญิงที่เกิดจากแม่เดียวกัน กี่คน

        // ผู้ป่วยทั้งหมด เป็นคนไข้ รพ.รามาธิบดี กี่คน  รพ.อื่นกี่คน

        // Find Total records
        $Duchenne_total = DB::select('SELECT  count(disease_1.questions_id) as total FROM disease_1 ');
        // Find Family nubmer
        $Family_total = DB::select('SELECT  COUNT(family_name.person_last_name) as total
		FROM ( SELECT persons.person_id, persons.person_last_name, COUNT(persons.person_last_name) as count
				FROM persons, patients , patients_disease_forms , disease_forms
				WHERE patients_disease_forms.question_id  = disease_forms.question_id
				AND patients_disease_forms.patient_id = patients.patient_id
				AND patients.person_id = persons.person_id
				AND disease_forms.disease_type_id = 1
				GROUP BY person_last_name ) as family_name');
        // Find ครั้งแรกที่เริ่มมีปัญหาการเดินหรือการลุกยืน อายุ
        $Symp2_mean = DB::select('SELECT AVG(disease_1.symptom_2) as mean FROM disease_1 where symptom_2 != 0 ');
        $Symp2_median = DB::select('SELECT avg(t1.symptom_2) as median_val FROM (
                                        SELECT @rownum:=@rownum+1 as row_number, d.symptom_2
                                          FROM disease_1 d,  (SELECT @rownum:=0) r
                                          WHERE symptom_2 != 0
                                          ORDER BY d.symptom_2
                                        ) as t1, 
                                        (
                                          SELECT count(*) as total_rows
                                          FROM disease_1 d
                                          WHERE symptom_2 != 0
                                        ) as t2
                                        WHERE 1
                                        AND t1.row_number in ( floor((total_rows+1)/2), floor((total_rows+2)/2) ) ');
        $Symp2_SD = DB::select('SELECT STD(symptom_2)  as sd from disease_1 where symptom_2 != 0 ');
        $Symp2_range = DB::select('SELECT  MIN(symptom_2) AS Min, MAX(symptom_2) AS Max FROM   disease_1 where symptom_2 != 0');

        //ครั้งแรกที่เริ่มพาไปตรวจเรื่องปัญหาการเดินหรือการลุกยืน อายุ
        $Symp3_mean = DB::select('SELECT AVG(disease_1.symptom_3) as mean FROM disease_1 where symptom_3 != 0 ');
        $Symp3_median = DB::select('SELECT avg(t1.symptom_3) as median_val FROM (
                                      SELECT @rownum:=@rownum+1 as row_number, d.symptom_3
                                      FROM disease_1 d,  (SELECT @rownum:=0) r
                                      WHERE symptom_3 != 0
                                      ORDER BY d.symptom_3
                                    ) as t1, 
                                    (
                                      SELECT count(*) as total_rows
                                      FROM disease_1 d
                                      WHERE symptom_3 != 0
                                    ) as t2
                                    WHERE 1
                                    AND t1.row_number in ( floor((total_rows+1)/2), floor((total_rows+2)/2) ) ');
        $Symp3_SD = DB::select('SELECT STD(symptom_3)  as sd from disease_1 where symptom_2 != 0 ');
        $Symp3_range = DB::select('SELECT  MIN(symptom_3) AS Min, MAX(symptom_3) AS Max FROM   disease_1 where symptom_3 != 0');

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

        //Find  Attention Deficit Disorder
        $Attention_Deficit_Disorder = DB::select('SELECT  count(questions_id) as disorder
		FROM disease_1
		where symptom_4_1 = "เป็น" ');
        //FInd Autistic
        $Autistic = DB::select(' SELECT count(disease_1.questions_id) as disorder
		FROM disease_1
		where symptom_4_2 = "เป็น" ');
        //Find Snorring
        $Snorring = DB::select(' SELECT count(disease_1.questions_id) as disorder
		FROM disease_1
		where symptom_4_3 = "เป็น" ');
        // Find  tired
        $Tired = DB::select(' SELECT count(disease_1.questions_id) as  disorder
		FROM disease_1
		where symptom_4_4 = "เป็น"	');


        // Find Echocardiogram
        $Echocardiogram = DB::select('SELECT count(disease_1.questions_id) as tested FROM disease_1 where symptom_6 = "ตรวจ" ');
        $UnEchocardiogram = DB::select('SELECT count(disease_1.questions_id) as un_test FROM disease_1 where symptom_6 = "ไม่ได้ตรวจ" ');
        $Echocardiogram_noresult = DB::select('SELECT persons.person_id , persons.person_first_name , persons.person_last_name ,persons.person_sex
                                                FROM  persons ,patients ,disease_1 ,patients_disease_forms
                                                where patients_disease_forms.question_id  = disease_1.questions_id
                                                AND patients_disease_forms.patient_id = patients.patient_id
                                                AND patients.person_id = persons.person_id
                                                AND disease_1.symptom_6 = "ไม่ได้ตรวจ" ');
        $Echo_mean = DB::select('SELECT AVG(disease_1.symptom_6_result) as mean FROM disease_1 where symptom_6 = "ตรวจ" ');
        $Echo_median = DB::select('SELECT avg(t1.symptom_6_result) as median_val FROM (
                                        SELECT @rownum:=@rownum+1 as `row_number`, d.symptom_6_result
                                          FROM disease_1 d,  (SELECT @rownum:=0) r
                                          WHERE d.symptom_6 = "ตรวจ"
                                          ORDER BY d.symptom_6_result
                                        ) as t1, 
                                        (
                                          SELECT count(*) as total_rows
                                          FROM disease_1 d
                                          WHERE d.symptom_6 = "ตรวจ"
                                        ) as t2
                                        WHERE 1
                                        AND t1.row_number in ( floor((total_rows+1)/2), floor((total_rows+2)/2) ) ');
        $Echo_SD = DB::select('SELECT STD(symptom_6_result)  as sd from disease_1 where symptom_6 = "ตรวจ" ');
        $Echo_range = DB::select('SELECT  MIN(symptom_6_result) AS Min, MAX(symptom_6_result) AS Max FROM   disease_1 where symptom_6 = "ตรวจ" ');


        // Find CK
        $CK_mean = DB::select('SELECT AVG(disease_1.symptom_5_result) as mean FROM disease_1 where symptom_6 = "ตรวจ" ');
        $CK_median = DB::select('SELECT avg(t1.symptom_5_result) as median_val FROM (
                                    SELECT @rownum:=@rownum+1 as row_number, d.symptom_5_result
                                      FROM disease_1 d,  (SELECT @rownum:=0) r
                                      WHERE d.symptom_5 = "มี"
                                      ORDER BY d.symptom_5_result
                                    ) as t1, 
                                    (
                                      SELECT count(*) as total_rows
                                      FROM disease_1 d
                                      WHERE d.symptom_5 = "มี"
                                    ) as t2
                                    WHERE 1
                                    AND t1.row_number in ( floor((total_rows+1)/2), floor((total_rows+2)/2) ) ');
        $CK_SD = DB::select('SELECT STD(symptom_5_result)  as sd from disease_1 where symptom_5 = "มี" ');
        $CK_range = DB::select('SELECT  MIN(symptom_5_result) AS Min, MAX(symptom_5_result) AS Max FROM   disease_1 where symptom_5 = "มี" ');
        $Ck = DB::select('SELECT count(disease_1.questions_id) as tested FROM disease_1 where symptom_5 = "มี" ');
        $UnCk = DB::select('SELECT count(disease_1.questions_id) as un_test FROM disease_1 where symptom_5 = "ไม่มี" ');
        $Ck_noresult = DB::select('SELECT persons.person_id , persons.person_first_name , persons.person_last_name ,persons.person_sex
                                    FROM  persons ,patients ,disease_1 ,patients_disease_forms
                                    where patients_disease_forms.question_id  = disease_1.questions_id
                                    AND patients_disease_forms.patient_id = patients.patient_id
                                    AND patients.person_id = persons.person_id
                                    AND disease_1.symptom_5 = "ไม่มี"  ');

        //Find hostpital
        $hospital = DB::select('SELECT count(patients.patient_id) as total  , doctors.hospital
                                    from doctors , patients, ( SELECT patients_disease_forms.question_id ,patients_disease_forms.patient_id
                                                        FROM patients_disease_forms , disease_forms
                                                        WHERE patients_disease_forms.question_id = disease_forms.question_id AND disease_forms.disease_type_id = 1
                                                    ) AS a1
                                    WHERE patients.patient_id = a1.patient_id AND patients.doctor_id  = doctors.doctor_id
                                    GROUP BY doctors.hospital');


        return view('duchenne_report')
            ->with('Symp2_SD', $Symp2_SD)
            ->with('Symp2_range', $Symp2_range)
            ->with('Symp2_median', $Symp2_median)
            ->with('Symp2_mean', $Symp2_mean)
            ->with('Symp3_SD', $Symp3_SD)
            ->with('Symp3_range', $Symp3_range)
            ->with('Symp3_median', $Symp3_median)
            ->with('Symp3_mean', $Symp3_mean)
            ->with('Duchenne_total', $Duchenne_total)
            ->with('Family_total', $Family_total)
            ->with('Attention_Deficit_Disorder', $Attention_Deficit_Disorder)
            ->with('Autistic', $Autistic)
            ->with('Snorring', $Snorring)
            ->with('Tired', $Tired)
            ->with('Echocardiogram', $Echocardiogram)
            ->with('UnEchocardiogram', $UnEchocardiogram)
            ->with('Echocardiogram_noresult', $Echocardiogram_noresult)
            ->with('Echo_mean', $Echo_mean)
            ->with('Echo_median', $Echo_median)
            ->with('Echo_SD', $Echo_SD)
            ->with('Echo_range', $Echo_range)
            ->with('Ck', $Ck)
            ->with('UnCk', $UnCk)
            ->with('Ck_noresult', $Ck_noresult)
            ->with('CK_mean', $CK_mean)
            ->with('CK_median', $CK_median)
            ->with('CK_SD', $CK_SD)
            ->with('CK_range', $CK_range)
            ->with('TakeAnyTreatment', $Attention_Deficit_Disorder)
            ->with('DontTakeTreatment', $Autistic)
            ->with('PCR', $Snorring)
            ->with('MLPA', $Tired)
            ->with('TakeAnyTreatment', $TakeAnyTreatment)
            ->with('DontTakeTreatment', $DontTakeTreatment)
            ->with('PCR', $PCR)
            ->with('MLPA', $MLPA)
            ->with('Sequencing', $Sequencing)
            ->with('hospital', $hospital);
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
     * Display the duchenne patients
     *
     *
     *
     */
    public function show_patient_duchenne()
    {
        $persons = DB::select('SELECT persons.person_id , persons.person_first_name , persons.person_last_name ,persons.person_citizenID
				FROM  persons ,patients ,disease_1 ,patients_disease_forms ,disease_forms
				where patients_disease_forms.question_id  = disease_1.questions_id
				AND patients_disease_forms.patient_id = patients.patient_id
				AND patients.person_id = persons.person_id
                AND disease_forms.question_id = patients_disease_forms.question_id
				AND disease_forms.disease_type_id =  1 ');
        $data = array();
        foreach ($persons as $person) {
            $p = array();
            /*$p['firstname']  = $person->person_first_name ; // add dad to list
            $p['lastname'] = $person->person_last_name;
            $p['citizenID'] = $person->person_citizenID;*/
            $p['ID'] = $person->person_id;
            $p['display'] = $person->person_id . " " . $person->person_first_name . " " . $person->person_last_name . " " . $person->person_citizenID;
            $data[] = $p;
        }
        return response()->json($data, 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function duchenne_find_namelist_symptom_10($id)
    {

    }

}
