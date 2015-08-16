
@extends('app')
@section('content')
<script type="text/javascript">
$(document).ready(function() {
	$("#5_2_symptom_add_one").hide();
	$('#datetimepicker1').datetimepicker({
		format: "dd MM yyyy - HH:ii P",
		showMeridian: true,
		autoclose: true,
		todayBtn: true
	});
	$('#datetimepicker2').datetimepicker({
		format: "dd MM yyyy - HH:ii P",
		showMeridian: true,
		autoclose: true,
		todayBtn: true
	});
	$('#datetimepicker3').datetimepicker({
		format: "dd MM yyyy - HH:ii P",
		showMeridian: true,
		autoclose: true,
		todayBtn: true
	});
	$('input[name=5_symptom]').click(function () {
		if (this.id == "5_2_symptom") {
			$("#5_2_symptom_add_on").show('slow');
		} else {
			$("#5_2_symptom_add_one").hide('slow');
		}
	});



});
</script>
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">แบบการบันทึกความผิดปกติแต่กำเนิดแห่งประเทศไทย
				( แบบที่ 3 สำหรับความผิดปกติโรคกล้ามเนื้อเสื่อมดูเชนน์ )</div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="/auth/register">
						<div class="form-group">
							<label class="col-md-4 control-label">เพศ</label>
							<div class="col-md-6">
								<input checked="checked" name="sex" type="radio" value="male" />&nbsp;ชาย&nbsp;<input name="sex" type="radio" value="female" />&nbsp;หญิง&nbsp;</p>
							</div>
							<label class="col-md-4 control-label">ชื่อ-นามสกุล</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">วันเดือนปีเกิด</label>
							<div class='col-md-6 input-group date' id='datetimepicker1'>
								<input type='text' name="date" class="form-control" />
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
								<input type="text" class="form-control" name="id_citizen" >
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
								<input type="text" class="form-control" name="mobi_phone_number">
							</div>
							<label class="col-md-1 control-label">มือถือ</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="house_number">
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
									<input type="radio" name="1_1_symptom" id="1_1_symptom" autocomplete="off" checked> ไม่เป็น
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="1_1_symptom" id="1_2_symptom" autocomplete="off"> เป็น
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="1_1_symptom" id="1_3_symptom" autocomplete="off"> ไม่ได้สังเกต
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
									<input type="radio" name="4_1_symptom" id="4_1_symptom" autocomplete="off" checked> ไม่เป็น
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="4_1_symptom" id="4_2_symptom" autocomplete="off"> เป็น
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
								<div id="5_2_symptom_add_on" >
									<label class="col-md-1 ">ผล</label>
									<div class="col-md-2">
										<input type="text" class="form-control" name="5_2_symptom_add_on_result">
									</div>
									<label class="col-md-2">ครั้งแรก เมื่อ วัน-เดือน-ปี</label>
									<div class='col-md-2 input-group date' id='datetimepicker2'>
										<input type='text' name="5_2_symptom_add_on_result_date" class="form-control" />
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
									<div class="col-md-2">
										<input type="text" class="form-control" name="6_2_symptom_add_on_result">
									</div>
									<label class="col-md-2">ครั้งสุดท้าย เมื่อ วัน-เดือน-ปี</label>
									<div class='col-md-2 input-group date' id='datetimepicker3'>
										<input type='text' name="6_2_symptom_add_on_result_date" class="form-control" />
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
										<input type="radio" name="7_1_symptom" id="7_1_symptom" autocomplete="off" checked> ปกติ
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="7_1_symptom" id="7_2_symptom" autocomplete="off"> ไม่ได้ตรวจ
									</label>
									<label class="btn btn-primary">
										<input type="radio" name="7_1_symptom" id="7_3_symptom" autocomplete="off"> ผิดปกติ
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
									<input type="radio" name="7_2_symptom" id="7_4_symptom" value="ไม่เป็น" autocomplete="off" checked> ปกติ
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="7_2_symptom" id="7_5_symptom" value="เป็น" autocomplete="off"> ไม่ได้ตรวจ
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="7_2_symptom" id="7_6_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ผิดปกติ
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
									<input type="radio" name="7_3_symptom" id="7_7_symptom" value="ไม่เป็น" autocomplete="off" checked> ปกติ
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="7_3_symptom" id="7_8_symptom" value="เป็น" autocomplete="off"> ไม่ได้ตรวจ
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="7_3_symptom" id="7_9_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ผิดปกติ
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
									<input  type="checkbox" type="checkbox_male">ชาย
								</label>
							</div>
							<div class="col-md-2 text-left">
								<input type="text" class="form-control" name="checkbox_male_number" value="" placeholder="คน">
							</div>
							<div class="checkbox col-md-1">
								<label>
									<input  type="checkbox" name="checkbox_female">หญิง
								</label>
							</div>
							<div class="col-md-2 text-left">
								<input type="text" class="form-control" name="checkbox_female_number" value="" placeholder="คน">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 text-left">10. ประวัติครอบครัว มารดา  </label>
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-primary active">
									<input type="radio" name="6_symptom" id="6_1_symptom" value="ไม่ได้ตรวจ" autocomplete="off" checked> ไม่ได้ตรวจ
								</label>
								<label class="btn btn-primary">
									<input type="radio" name="6_symptom" id="6_2_symptom" value="ตรวจ" autocomplete="off"> ตรวจ
								</label>
							</div>
						</div>
						<div class="form-group">
						<label class="col-md-3 control-label">10.1 รายชือญาติที่ป่วยเป็นโรคกล้ามเนื้อ</label>
						<button type="submit" class="btn btn-primary">
							Add more
						</button>
						<div class="checkbox col-md-2">
							<label>
								<input  type="checkbox" name="10_checkbox_male">ไม่รู้: ติดตามเพิ่มเติม
							</label>
						</div>
						</div>
						<div class="form-group">
						<div class="col-md-2">
							<input type="text" class="form-control" name="ban_number" placeholder="ชื่อ-นามสกุล">
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control" name="ban_number" placeholder="อายุ" >
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control" name="ban_number" placeholder="เลขประจำตัวประชาชน">
						</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 text-left">10.2 มารดามีพี่น้องแม่เดียวกัน กี่คน  </label>
							<div class="checkbox col-md-1">
								<label>
									<input  type="checkbox" name="10_checkbox_male">ชาย
								</label>
							</div>
							<div class="col-md-2 text-left">
								<input type="text" class="form-control" name="checkbox_male_number" value="" placeholder="คน">
							</div>
							<div class="checkbox col-md-1">
								<label>
									<input  type="checkbox" name="10_checkbox_female">หญิง
								</label>
							</div>
							<div class="col-md-2 text-left">
								<input type="text" class="form-control" name="checkbox_female_number" value="" placeholder="คน">
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
							<div class='col-md-6 input-group date' id='datetimepicker2'>
								<input type='text' name="doctor_date" class="form-control" />
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
								<input type="text" class="form-control" name="doctor_phonenumber" >
							</div>
						</div>

						<hr>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>

				</div>
				<div class="panel-footer">Panel footer</div>
			</div>

		</div>
	</div>
	@endsection
