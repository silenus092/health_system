<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  </head>
  <body>
<!-- <div class="loader"></div> -->
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">แบบการบันทึกความผิดปกติแต่กำเนิดแห่งประเทศไทย
				( แบบที่ 3 สำหรับความผิดปกติโรคกล้ามเนื้อเสื่อมดูเชนน์ )</div>
			<div class="panel-body">
					<div class="form-group">
						<label class="col-md-4 control-label">เพศ</label>
						<?php echo $patient_report->person_sex; ?>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">ชื่อ</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="first_name" value="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">นามสกุล</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="last_name" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">วันเดือนปีเกิด</label>
						<div class='col-md-6 input-group date' id='datetimepicker1'>
							<input type='text' name="birth_date" class="form-control" />
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">อายุ</label>
						<div class='col-md-6' >
							<input type="text" class="form-control" name="age" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">เลขที่บัตรประชาชน</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="citizen_id" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-1 control-label">บ้านเลขที่</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="ban_number">
						</div>
						<label class="col-md-1 control-label">หมู่</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="mooh_number">
						</div>
						<label class="col-md-1 control-label">ซอย</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="soi">
						</div>
						<label class="col-md-1 control-label">ถนน</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="road">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-1 control-label">ตำบล</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="sub_district">
						</div>
						<label class="col-md-1 control-label">อำเภอ</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="district">
						</div>
						<label class="col-md-1 control-label">จังหวัด</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="province">
						</div>
						<label class="col-md-1 control-label">รหัสไปรษณีย์</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="postal_code">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-1 control-label">โทรศัพท์</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="house_number">
						</div>
						<label class="col-md-1 control-label">มือถือ</label>
						<div class="col-md-4">
							<input type="text" class="form-control" name="mobi_phone_number">
						</div>
					</div>
					<hr>
					<div class="form-group">
						<label class="col-md-4 text-left">1.อาการของผู้ป่วย ณ ปัจจุบัน</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.1 เดินเขย่ง หลังแอ่น เดินขาปัด ล้มบ่อย </label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="1_1_symptom" id="1_1_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_1_symptom" id="1_2_symptom" value="เป็น" autocomplete="off"> เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_1_symptom" id="1_3_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left" >1.2 ลุกขึ้นยืนลำบากต้องเหนี่ยวจับหรือเกาะขึ้นยืน (ท่าโกเวอร์)</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="1_2_symptom" id="1_4_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_2_symptom" id="1_5_symptom" value="เป็น" autocomplete="off"> เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_2_symptom" id="1_6_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.3 เดินไม่ได้แล้ว</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="1_3_symptom" id="1_7_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_3_symptom" id="1_8_symptom" value="เป็น" autocomplete="off"> เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_3_symptom" id="1_9_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">2. ครั้งแรกที่เริ่มมีปัญหาการเดินหรือการลุกยืน  อายุ</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="2_symptom_age" placeholder="ปี">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">3. ครั้งแรกที่เริ่มพาไปตรวจเรื่องปัญหาการเดินหรือการลุกยืน อายุ </label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="3_symptom_age" placeholder="ปี">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 text-left">4.ปัญหาอื่นๆ</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.1 สมาธิสั้น</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_1_symptom" id="4_1_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_1_symptom" id="4_2_symptom"  value="เป็น" autocomplete="off"> เป็น
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left" >4.2 ลักษณะคล้ายออทิสติก</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_2_symptom" id="4_3_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_2_symptom" id="4_4_symptom" value="เป็น" autocomplete="off"> เป็น
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.3 นอนกรน</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_3_symptom" id="4_5_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_3_symptom" id="4_6_symptom" value="เป็น" autocomplete="off"> เป็น
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.4  เหนื่องง่าย หรือนอนราบไม่ได้ (ต้องใช้หมอนมากกว่า 1 ใบ)</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_4_symptom" id="4_7_symptom" value="ไม่เป็น" autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_4_symptom" id="4_8_symptom" value="เป็น" autocomplete="off"> เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_4_symptom" id="4_9_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">5. มีผลตรวจระดับเอนไซม์กล้ามเนื้อ (ซีเค creatinine kinase) หรือไม่</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="5_symptom" id="5_1_symptom" value="ไม่มี" autocomplete="off" checked> ไม่มี
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="5_symptom" id="5_2_symptom" value="มี" autocomplete="off"> มี
							</label>
						</div>
						<p>
						<div id="5_2_symptom_add_on">
							<label class="col-md-1 ">ผล</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="5_2_symptom_add_on_result" name="5_2_symptom_add_on_result" disabled="true">
							</div>
							<label class="col-md-2">ครั้งแรก เมื่อ วัน-เดือน-ปี</label>
							<div class='col-md-2 input-group date' id='datetimepicker2'>
								<input type='text' id="5_2_symptom_add_on_result_date" name="5_2_symptom_add_on_result_date" class="form-control" disabled="true" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						</p>
					</div>
				<div class="form-group">
					<label class="col-md-6 text-left">6. ได้ตรวจ เอคโค (Echocardiogram) หรือไม่</label>
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-primary active">
							<input type="radio" name="6_symptom" id="6_1_symptom" value="ไม่ได้ตรวจ" autocomplete="off" checked> ไม่ได้ตรวจ
						</label>
						<label class="btn btn-primary">
							<input type="radio" name="6_symptom" id="6_2_symptom" value="ตรวจ" autocomplete="off"> ตรวจ
						</label>
					</div>
					<p>
					<div id="6_2_symptom_add_on" >
						<label class="col-md-1 ">ผล</label>
						<div class="col-md-4">
							<input type="text" class="form-control" id="6_2_symptom_add_on_result" name="6_2_symptom_add_on_result" disabled="true">
						</div>
						<label class="col-md-2">ครั้งสุดท้าย เมื่อ วัน-เดือน-ปี</label>
						<div class='col-md-2 input-group date' id='datetimepicker3'>
							<input type='text' id="6_2_symptom_add_on_result_date" name="6_2_symptom_add_on_result_date"  class="form-control" disabled="true"/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
					</p>
			</div>
			<div class="form-group">
				<label class="col-md-6 text-left">7. การตรวจยีนโรคกล้ามเนื้อเสื่อมดูเชน ของผู้ป่วย ด้วยวิธีต่อไปนี้และผลดังนี้ </label>
			</div>

			<div class="form-group">
				<label class="col-md-2 text-left">7.1 Multiplex PCR </label>
				<div class="col-md-3 btn-group" data-toggle="buttons">
					<label class="btn btn-primary active">
						<input type="radio" name="7_1_symptom" id="7_1_symptom" value="ปกติ"  autocomplete="off" checked> ปกติ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="7_1_symptom" id="7_2_symptom" value="ไม่ได้ตรวจ" autocomplete="off"> ไม่ได้ตรวจ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="7_1_symptom" id="7_3_symptom" value="ผิดปกติ" autocomplete="off"> ผิดปกติ
					</label>
				</div>
				<div class="col-md-5" >
					<input type="text" class="col-md-5 form-control" name="7_1_symptom_result" placeholder="ผล">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 text-left" >7.2 MLPA </label>
				<div class="col-md-3 btn-group" data-toggle="buttons">
					<label class="btn btn-primary active">
						<input type="radio" name="7_2_symptom" id="7_4_symptom" value="ปกติ" autocomplete="off" checked> ปกติ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="7_2_symptom" id="7_5_symptom" value="ไม่ได้ตรวจ" autocomplete="off"> ไม่ได้ตรวจ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="7_2_symptom" id="7_6_symptom" value="ผิดปกติ" autocomplete="off"> ผิดปกติ
					</label>
				</div>
				<div class="col-md-5" >
					<input type="text" class="col-md-5 form-control" name="7_2_symptom_result" placeholder="ผล">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-2 text-left">7.3 Sequencing</label>
				<div class="col-md-3 btn-group" data-toggle="buttons">
					<label class="btn btn-primary active">
						<input type="radio" name="7_3_symptom" id="7_7_symptom" value="ปกติ" autocomplete="off" checked> ปกติ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="7_3_symptom" id="7_8_symptom" value="ไม่ได้ตรวจ" autocomplete="off"> ไม่ได้ตรวจ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="7_3_symptom" id="7_9_symptom" value="ผิดปกติ" autocomplete="off"> ผิดปกติ
					</label>
				</div>
				<div class="col-md-5" >
					<input type="text" class="col-md-5 form-control" name="7_3_symptom_result" placeholder="ผล">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-6 text-left">8. ผลตรวจยีนของมารดา</label>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-primary active">
						<input type="radio" name="8_1_symptom" id="8_1_symptom" value="เป็นพาหะ" autocomplete="off" checked> เป็นพาหะ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="8_1_symptom" id="8_2_symptom" value="ไม่เป็นพาหะ" autocomplete="off"> ไม่เป็นพาหะ
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="8_1_symptom" id="8_3_symptom" value="ไม่รู้" autocomplete="off">ยังไม่ได้ตรวจ / ไม่รู้
					</label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 text-left">	9. ผู้ป่วยมีพี่น้องแม่เดียวกันกี่คน </label>
				<div class="checkbox col-md-1">
					<label>
						ชาย
					</label>
				</div>
				<div class="col-md-2 text-left">
					<input type="text" class="form-control" name="9_male_number" value="" placeholder="คน">
				</div>
				<div class="checkbox col-md-1">
					<label>
						หญิง
					</label>
				</div>
				<div class="col-md-2 text-left">
					<input type="text" class="form-control" name="9_female_number" value="" placeholder="คน">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 text-left">10. ประวัติครอบครัว มารดา  </label>
			</div>
			<div class="form-group">
				<label class="col-md-5">
					10.1 มีหรือเคยมีพี่น้องเพศชาย หรือญาติเพศชายป่วยเป็นโรคกล้ามเนื้อหรือไม่
				</label>
				<div class="col-md-2 btn-group"  data-toggle="buttons">
					<label class="btn btn-primary active">
						<input type="radio" name="10_symptom" id="10_1_symptom" value="ไม่มี" autocomplete="off" checked> ไม่มี
					</label>
					<label class="btn btn-primary">
						<input type="radio" name="10_symptom" id="10_2_symptom" value="มี" autocomplete="off"> มี
					</label>
				</div>
				<div class="col-md-2">
					<input type="text" class="form-control" id="10_symptom_number" name="10_symptom_number" disabled="true" placeholder="กี่คน">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-6 control-label">รายชือญาติที่ป่วยเป็นโรคกล้ามเนื้อ ระบุว่าเป็นใครบ้าง และอายุเท่าไหร่ พร้อมเลขที่บัตรประชาชน</label>

				<input type="button" id="add_more" value="Add More"  class="btn btn-primary" />

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
				<div class="form-group">
					<label class="col-md-1 control-label">Relationship</label>
					<div class="col-md-2  selectContainer">
						<select name="10_roles[] " class="form-control field_roles">
							<option value="ปู่ทวด">ปู่ทวด</option>
							<option value="ปู่">ปู่</option>
							<option value="ตา">ตา</option>
							<option value="น้า">น้า</option>
							<option value="ลุง">ลุง</option>
							<option value="พ่อ">พ่อ</option>
							<option value="พี่ชาย">พี่ชาย</option>
							<option value="น้องชาย">น้องชาย</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 text-left">10.2 มารดามีพี่น้องแม่เดียวกัน กี่คน  </label>
				<div class="checkbox col-md-1">
					<label>
						ชาย
					</label>
				</div>
				<div class="col-md-2 text-left">
					<input type="text" class="form-control" name="10_2_male_number" value="" placeholder="คน">
				</div>
				<div class="checkbox col-md-1">
					<label>
						หญิง
					</label>
				</div>
				<div class="col-md-2 text-left">
					<input type="text" class="form-control" name="10_2_female_number" value="" placeholder="คน">
				</div>
			</div>
			<hr>
			<div class="form-group">
				<label class="col-md-4 control-label">คนไข้จากโรงพยาบาล </label>
				<div class='col-md-6' >
					<input type="text" class="form-control" name="hospital_name" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-8 control-label">แพทย์เจ้าของไข้</label>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">วัน-เดือน-ปี ที่บันทึกข้อมูลโดยแพทย์เจ้าของไข้</label>
				<div class='col-md-6 input-group date' id='datetimepicker4'>
					<input type='text' name="doctor_care_date" class="form-control" />
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">ชื่อ-นามสกุล</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="doctor_name" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">เบอร์โทร</label>
				<div class='col-md-6' >
					<input type="text" class="form-control" name="doctor_mobilephonenumber" value="">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">โทรสาร</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="doctor_phonenumber" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">email</label>
				<div class="col-md-6">
					<input type="text" class="form-control" name="doctor_email" >
				</div>
			</div>

			<hr>
			<div class="form-group">
				<div class="col-md-6 col-md-offset-4">
					<input type="button" id="submit" value="submit"  class="btn btn-primary" />
				</div>
			</div>
	

	</div>
	<div class="panel-footer">Panel footer</div>
</div>

</div>
</div>

</body>
</html>
