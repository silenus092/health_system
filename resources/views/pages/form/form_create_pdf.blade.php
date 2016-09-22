<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	</head>
    <style>


    </style>
	<body>

			<div class="">แบบการบันทึกความผิดปกติแต่กำเนิดแห่งประเทศไทย
				( แบบที่ 3 สำหรับความผิดปกติโรคกล้ามเนื้อเสื่อมดูเชนน์ )</div>
			<hr>
               	<h3 style="text-align:center;" >ประวัติผู้ป่วย</h3>

            <p>

				<?php if ($patient_report->profile_img != null) {
				echo '<img   style="float: right; width: 100px; height: 100px;" class="img-circle img-responsive uploader" width="300px" height="350px" src="' . asset('../public/uploads/' . $patient_report->profile_img) . '"><br />';
				} else {
				echo '<img   style="float: right; width: 100px; height: 100px;" class="img-circle img-responsive uploader"  alt="no_floor_image" width="300px" height="350px" src="' . asset('../public/images/person.png') . '"><br />';
				} ?>
                <label class="col-md-4 control-label"> สถานะ :</label>
                <?php if($patient_report->person_alive == 1){
                    echo "<font color='green'>ยังมีชีวิตอยู่</font>";
                }else if($patient_report->person_alive == 0){
                    echo "<font color='red'>เสียชีวิตเเล้ว</font>";
                }else{
                    echo "ระบุไม่ได้";
                }
                ?>
                &nbsp;&nbsp;
                <label class="col-md-4 control-label ">เพศ :</label>
                <?php echo $patient_report->person_sex; ?>
                <br>
                <label class="col-md-4 control-label">ชื่อ :</label>
                <?php echo $patient_report->person_first_name; ?>
                &nbsp;&nbsp;
                <label class="col-md-4 control-label">นามสกุล :</label>
                <?php echo $patient_report->person_last_name; ?>
                &nbsp;&nbsp;
                <label class="col-md-4 control-label">เลขที่บัตรประชาชน :</label>
                <?php echo $patient_report->person_citizenID; ?>
                <br>
                <label class="col-md-4 control-label">วันเดือนปีเกิด :</label>
                <?php echo $patient_report->person_birth_date; ?>
                &nbsp;&nbsp;
                <label class="col-md-4 control-label">อายุ :</label>
                <?php echo $patient_report->person_age; ?>
                <br>
                <label class="col-md-1 control-label">บ้านเลขที่ :</label>
                <?php echo $patient_report->person_house_num; ?>
                <label class="col-md-1 control-label">หมู่ :</label>
                <?php echo $patient_report->person_mooh_num; ?>
                <label class="col-md-1 control-label">ซอย :</label>
                <?php echo $patient_report->person_soi; ?>
                <label class="col-md-1 control-label">ถนน :</label>
                <?php echo $patient_report->person_road; ?>
                <br>
                <label class="col-md-1 control-label">ตำบล :</label>
                <?php echo $patient_report->person_tumbon; ?>
                <label class="col-md-1 control-label">อำเภอ :</label>
                <?php echo $patient_report->person_amphur; ?>
                <label class="col-md-1 control-label">จังหวัด :</label>
                <?php echo $patient_report->person_province; ?>
                <label class="col-md-1 control-label">รหัสไปรษณีย์ :</label>
                <?php echo $patient_report->person_post_code; ?>
                <br>
                <label class="col-md-1 control-label">โทรศัพท์ :</label>
                <?php echo $patient_report->person_mobile_phone; ?>
                <label class="col-md-1 control-label">มือถือ :</label>
                <?php echo $patient_report->person_phone; ?>

            </p>




					<hr>
					<div class="form-group">
						<label class="col-md-4 text-left">1.อาการของผู้ป่วย ณ ปัจจุบัน</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">   &nbsp;&nbsp;1.1 เดินเขย่ง หลังแอ่น เดินขาปัด ล้มบ่อย :</label>
						<?php echo $patient_report->symptom_1_1; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left" >   &nbsp;&nbsp;1.2 ลุกขึ้นยืนลำบากต้องเหนี่ยวจับหรือเกาะขึ้นยืน (ท่าโกเวอร์) :</label>
						<?php echo $patient_report->symptom_1_2; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">   &nbsp;&nbsp;1.3 เดินไม่ได้แล้ว :</label>
						<?php echo $patient_report->symptom_1_3; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">2. ครั้งแรกที่เริ่มมีปัญหาการเดินหรือการลุกยืน  อายุ :</label>
						<?php echo $patient_report->symptom_2; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">3. ครั้งแรกที่เริ่มพาไปตรวจเรื่องปัญหาการเดินหรือการลุกยืน อายุ  :</label>
						<?php echo $patient_report->symptom_3; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 text-left"> 4.ปัญหาอื่นๆ</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">   &nbsp;&nbsp;4.1 สมาธิสั้น :</label>
						<?php echo $patient_report->symptom_4_1; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left" >   &nbsp;&nbsp;4.2 ลักษณะคล้ายออทิสติก :</label>
						<?php echo $patient_report->symptom_4_2; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">   &nbsp;&nbsp;4.3 นอนกรน :</label>
						<?php echo $patient_report->symptom_4_3; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">   &nbsp;&nbsp;4.4  เหนื่องง่าย หรือนอนราบไม่ได้ (ต้องใช้หมอนมากกว่า 1 ใบ) :</label>
						<?php echo $patient_report->symptom_4_4; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">5. มีผลตรวจระดับเอนไซม์กล้ามเนื้อ (ซีเค creatinine kinase) หรือไม่ :</label>			<?php echo $patient_report->symptom_5; ?>
						<div class="form-group">
							<label class="col-md-1 ">   &nbsp;&nbsp;ผล :</label>
							<?php echo $patient_report->symptom_5_result; ?>
						</div>
						<div class="form-group">
							<label class="col-md-2">   &nbsp;&nbsp;ครั้งแรก เมื่อ วัน-เดือน-ปี :</label>
							<?php echo $patient_report->symptom_5_date; ?>
						</div>

					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">6. ได้ตรวจ เอคโค (Echocardiogram) หรือไม่ :</label>
						<?php echo $patient_report->symptom_5; ?>

						<div class="form-group">
							<label class="col-md-1 ">&nbsp;&nbsp;ผล :</label>
							<?php echo $patient_report->symptom_6_result; ?>
						</div>
						<div class="form-group">
							<label class="col-md-2">&nbsp;&nbsp;ครั้งแรก เมื่อ วัน-เดือน-ปี :</label>
							<?php echo $patient_report->symptom_6_date; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">7. การตรวจยีนโรคกล้ามเนื้อเสื่อมดูเชน ของผู้ป่วย ด้วยวิธีต่อไปนี้และผลดังนี้ </label>
					</div>

					<div class="form-group">
						<label class="col-md-2 text-left">&nbsp;&nbsp;7.1 Multiplex PCR :</label>
						<?php echo $patient_report->symptom_7_1; ?>
					</div>
					<label class="col-md-2 text-left"> &nbsp;&nbsp;&nbsp;&nbsp;ผล :</label>
					<?php echo $patient_report->symptom_7_1_result; ?>
					<div class="form-group">
						<label class="col-md-2 text-left" >&nbsp;&nbsp;7.2 MLPA :</label>
						<?php echo $patient_report->symptom_7_2; ?>
					</div>
					<label class="col-md-2 text-left"> &nbsp;&nbsp;&nbsp;&nbsp;ผล :</label>
					<?php echo $patient_report->symptom_7_2_result; ?>
					<div class="form-group">
						<label class="col-md-2 text-left">&nbsp;&nbsp;7.3 Sequencing :</label>
						<?php echo $patient_report->symptom_7_3; ?>
					</div>
					<label class="col-md-2 text-left"> &nbsp;&nbsp;&nbsp;&nbsp;ผล :</label>
					<?php echo $patient_report->symptom_7_3_result; ?>
					<div class="form-group">
						<label class="col-md-6 text-left">8. ผลตรวจยีนของมารดา :</label>
						<?php echo $patient_report->symptom_8; ?>
					</div>
					<div class="form-group">
						<label class="col-md-3 text-left">	9. ผู้ป่วยมีพี่น้องแม่เดียวกันกี่คน </label>
						<div class="form-group">
							<label class="col-md-6 text-left"> &nbsp;&nbsp;ชาย :</label>
							<?php echo $patient_report->symptom_9_male; ?>
							<label class="col-md-6 text-left">  หญิง :</label>
							<?php echo $patient_report->symptom_9_female; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 text-left">10. ประวัติครอบครัว มารดา  </label>
					</div>
					<div class="form-group">
						<label class="col-md-5">
                            &nbsp;&nbsp;10.1 มีหรือเคยมีพี่น้องเพศชาย หรือญาติเพศชายป่วยเป็นโรคกล้ามเนื้อหรือไม่ :
						</label>
						<?php echo $patient_report->symptom_10_1; ?>
					</div>
					<div class="col-md-2">
						<label class="col-md-5">
                            &nbsp;&nbsp;&nbsp;&nbsp;จำนวน :
						</label>
						<?php echo $patient_report->symptom_10_1_number; ?>
					</div>

					<div class="form-group">
						<label class="col-md-6 control-label"><u>รายชือญาติที่ป่วยเป็นโรคกล้ามเนื้อ ระบุว่าเป็นใครบ้าง และอายุเท่าไหร่ พร้อมเลขที่บัตรประชาชน</u></label>


						<div class="checkbox col-md-2">
							<label>

								<?php echo ($patient_report->symptom_10_1_check == "ไม่รู้") ? 'ไม่รู้:
								ติดตามเพิ่มเติม' : '' ?>
							</label>
						</div>
					</div>

			<div class="form-group form-group_10">
				<?php  if(sizeof($result_relation) > 0){

				for($i = 0 ; $i < sizeof($result_relation) ; $i++){

				?>


					ชื่อ: <?php echo $result_relation[$i]->person_first_name.' '.$result_relation[$i]->person_last_name ?>
					&nbsp;&nbsp;


					อายุ: <?php echo $result_relation[$i]->person_age ?>
					&nbsp;&nbsp;

					บัตรประชาชน:<?php echo $result_relation[$i]->person_citizenID ?>
					&nbsp;&nbsp;

					<label class="col-md-1 control-label">Relationship: <?php echo $result_relation[$i]->role_description ?> </label>
					<br>
				<?php }
				}else{ ?>


				<?php }?>
			</div>


					<div class="form-group">
						<label class="col-md-3 text-left">&nbsp;&nbsp;10.2 มารดามีพี่น้องแม่เดียวกัน กี่คน  </label>
						<div class="checkbox col-md-1">
							<label>
                                &nbsp;&nbsp;&nbsp;&nbsp;ชาย :
							</label>
							<?php echo $patient_report->symptom_10_2_male; ?>

							<label>
                               หญิง :
							</label>
							<?php echo $patient_report->symptom_10_2_female; ?>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-md-4 control-label">คนไข้จากโรงพยาบาล :</label>
						<?php echo $patient_report->hospital; ?>
					</div>

						<h4 style="text-align:center;">ประวัติแพทย์เจ้าของไข้</h4></div>

					<div class="form-group">
						<label class="col-md-4 control-label">วัน-เดือน-ปี ที่บันทึกข้อมูลโดยแพทย์เจ้าของไข้ :</label>
						<?php echo $patient_report->doctor_care_date; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">ชื่อ-นามสกุล :</label>
							<?php echo $patient_report->doctor_name; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">เบอร์โทร :</label>
							<?php echo $patient_report->doctor_phone; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">โทรสาร :</label>
							<?php echo $patient_report->doctor_mobile_phobe; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">email :</label>
						<?php echo $patient_report->email; ?>

					</div>

					<hr>
				</div>


	</body>
</html>
