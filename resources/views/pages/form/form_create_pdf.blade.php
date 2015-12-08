<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html;" charset="utf-8"/>
		<!-- <link rel="stylesheet" href="http://localhost/health_system/public/scripts/css/bootstrap.min.css">
<link rel="stylesheet" href="http://localhost/health_system/public/scripts/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="http://localhost/health_system/public/css/app.css" rel="stylesheet">
<link rel="stylesheet" href="http://localhost/health_system/public/scripts/css/jquery-ui.css">

<script src="http://localhost/health_system/public/scripts/scripts/jquery-1.11.2.min.js"></script>
<script src="http://localhost/health_system/public/scripts/scripts/js/jquery-ui.min.js"></script>
<script src="http://localhost/health_system/public/scripts/scripts/js/bootstrap.min.js"></script> -->

	</head>
	<body>
		<div class="">
			<div class="">แบบการบันทึกความผิดปกติแต่กำเนิดแห่งประเทศไทย
				( แบบที่ 3 สำหรับความผิดปกติโรคกล้ามเนื้อเสื่อมดูเชนน์ )</div>
			<hr>
				<h3>ประวัติผู้ป่วย 
				</h3>
				<div class="form-group">
					<label class="col-md-4 control-label"> สถานะ :</label>
					<?php if($patient_report->person_alive == 1){
	echo "ยังมีชีวิตอยู่";
}else if($patient_report->person_alive == 0){
	echo "เสียชีวิตเเล้ว";
}else{
	echo "ระบุไม่ได้";
}
					?>

					<div class="form-group">
						<label class="col-md-4 control-label">เพศ :</label>
						<?php echo $patient_report->person_sex; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">ชื่อ :</label>
						<?php echo $patient_report->person_first_name; ?>
						&nbsp;&nbsp;
						<label class="col-md-4 control-label">นามสกุล :</label>
						<?php echo $patient_report->person_last_name; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">วันเดือนปีเกิด :</label>
						<?php echo $patient_report->person_birth_date; ?>
						&nbsp;&nbsp;
						<label class="col-md-4 control-label">อายุ :</label>
						<?php echo $patient_report->person_age; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">เลขที่บัตรประชาชน</label>
						<?php echo $patient_report->person_citizenID; ?>
					</div>

					<div class="form-group">
						<label class="col-md-1 control-label">บ้านเลขที่ :</label>
						<?php echo $patient_report->person_house_num; ?>
						<label class="col-md-1 control-label">หมู่ :</label>
						<?php echo $patient_report->person_mooh_num; ?>
						<label class="col-md-1 control-label">ซอย :</label>
						<?php echo $patient_report->person_soi; ?>
						<label class="col-md-1 control-label">ถนน :</label>
						<?php echo $patient_report->person_road; ?>
					</div>

					<div class="form-group">
						<label class="col-md-1 control-label">ตำบล :</label>
						<?php echo $patient_report->person_tumbon; ?>
						<label class="col-md-1 control-label">อำเภอ :</label>
						<?php echo $patient_report->person_amphur; ?>
						<label class="col-md-1 control-label">จังหวัด :</label>
						<?php echo $patient_report->person_province; ?>
						<label class="col-md-1 control-label">รหัสไปรษณีย์ :</label>
						<?php echo $patient_report->person_post_code; ?>
					</div>
					<div class="form-group">
						<label class="col-md-1 control-label">โทรศัพท์ :</label>
						<?php echo $patient_report->person_mobile_phone; ?>
						<label class="col-md-1 control-label">มือถือ :</label>
						<?php echo $patient_report->person_phone; ?>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-md-4 text-left">1.อาการของผู้ป่วย ณ ปัจจุบัน</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.1 เดินเขย่ง หลังแอ่น เดินขาปัด ล้มบ่อย :</label>
						<?php echo $patient_report->symptom_1_1; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left" >1.2 ลุกขึ้นยืนลำบากต้องเหนี่ยวจับหรือเกาะขึ้นยืน (ท่าโกเวอร์) :</label>
						<?php echo $patient_report->symptom_1_2; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.3 เดินไม่ได้แล้ว :</label>
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
						<label class="col-md-4 text-left">4.ปัญหาอื่นๆ</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.1 สมาธิสั้น :</label>
						<?php echo $patient_report->symptom_4_1; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left" >4.2 ลักษณะคล้ายออทิสติก :</label>
						<?php echo $patient_report->symptom_4_2; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.3 นอนกรน :</label>
						<?php echo $patient_report->symptom_4_3; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.4  เหนื่องง่าย หรือนอนราบไม่ได้ (ต้องใช้หมอนมากกว่า 1 ใบ) :</label>
						<?php echo $patient_report->symptom_4_4; ?>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">5. มีผลตรวจระดับเอนไซม์กล้ามเนื้อ (ซีเค creatinine kinase) หรือไม่ :</label>			<?php echo $patient_report->symptom_5; ?>
						<div class="form-group">
							<label class="col-md-1 ">ผล :</label>
							<?php echo $patient_report->symptom_5_result; ?>
						</div>
						<div class="form-group">
							<label class="col-md-2">ครั้งแรก เมื่อ วัน-เดือน-ปี :</label>
							<?php echo $patient_report->symptom_5_date; ?>
						</div>

					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">6. ได้ตรวจ เอคโค (Echocardiogram) หรือไม่ :</label>			
						<?php echo $patient_report->symptom_5; ?>

						<div class="form-group">
							<label class="col-md-1 ">ผล :</label>
							<?php echo $patient_report->symptom_6_result; ?>
						</div>
						<div class="form-group">
							<label class="col-md-2">ครั้งแรก เมื่อ วัน-เดือน-ปี :</label>
							<?php echo $patient_report->symptom_6_date; ?>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">7. การตรวจยีนโรคกล้ามเนื้อเสื่อมดูเชน ของผู้ป่วย ด้วยวิธีต่อไปนี้และผลดังนี้ </label>
					</div>

					<div class="form-group">
						<label class="col-md-2 text-left">7.1 Multiplex PCR :</label>
						<?php echo $patient_report->symptom_7_1; ?>
					</div>
					<label class="col-md-2 text-left"> ผล :</label>
					<?php echo $patient_report->symptom_7_1_result; ?>
					<div class="form-group">
						<label class="col-md-2 text-left" >7.2 MLPA :</label>
						<?php echo $patient_report->symptom_7_2; ?>
					</div>
					<label class="col-md-2 text-left"> ผล :</label>
					<?php echo $patient_report->symptom_7_2_result; ?>
					<div class="form-group">
						<label class="col-md-2 text-left">7.3 Sequencing :</label>
						<?php echo $patient_report->symptom_7_3; ?>
					</div>
					<label class="col-md-2 text-left"> ผล :</label>
					<?php echo $patient_report->symptom_7_3_result; ?>
					<div class="form-group">
						<label class="col-md-6 text-left">8. ผลตรวจยีนของมารดา :</label>
						<?php echo $patient_report->symptom_8; ?>
					</div>
					<div class="form-group">
						<label class="col-md-3 text-left">	9. ผู้ป่วยมีพี่น้องแม่เดียวกันกี่คน  :</label>
						<div class="form-group">
							<label class="col-md-6 text-left">ชาย :</label>
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
							10.1 มีหรือเคยมีพี่น้องเพศชาย หรือญาติเพศชายป่วยเป็นโรคกล้ามเนื้อหรือไม่ :
						</label>
						<?php echo $patient_report->symptom_10_1; ?>
					</div>
					<div class="col-md-2">
						<label class="col-md-5">
							จำนวน :
						</label>
						<?php echo $patient_report->symptom_10_1_number; ?>
					</div>
					
					<div class="form-group">
						<label class="col-md-6 control-label">รายชือญาติที่ป่วยเป็นโรคกล้ามเนื้อ ระบุว่าเป็นใครบ้าง และอายุเท่าไหร่ พร้อมเลขที่บัตรประชาชน</label>


						<div class="checkbox col-md-2">
							<label>
								<input  type="checkbox" id="10_symptom_checkbox" name="10_symptom_checkbox">ไม่รู้: ติดตามเพิ่มเติม
							</label>
						</div>
					</div>

					<div class="form-group form-group_10">
						<div class="col-md-2">
							<input type="text" class="form-control field_name" name="10_name[]" placeholder="1-ชื่อ-นามสกุล" required="true">
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control field_age" name="10_age[]" placeholder="อายุ" required="true">
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control field_id" name="10_citizen_number[]" placeholder="เลขประจำตัวประชาชน" required="true">
						</div>
				
					</div>
					<div class="form-group">
						<label class="col-md-3 text-left">10.2 มารดามีพี่น้องแม่เดียวกัน กี่คน  </label>
						<div class="checkbox col-md-1">
							<label>
								ชาย : 
							</label>
							<?php echo $patient_report->symptom_10_2_male; ?>
						</div>
						<div class="checkbox col-md-1">
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
					<div class="form-group">
						<label class="col-md-8 control-label">ประวัติแพทย์เจ้าของไข้</label>
					</div>
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

			</div>
		</div>
	</body>
</html>
