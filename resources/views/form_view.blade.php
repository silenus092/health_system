
@extends('app')

@section('content')
<script type="text/javascript">
$(function () {
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

	$("input:radio[name='group1']").click(function() {
    $('.desc').hide();
    $('#' + $("input:radio[name='group1']:checked").val()).show();
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
								<label class="btn btn-primary">
									<input type="radio" name="5_symptom" id="5_3_symptom" value="ไม่ได้สังเกต" autocomplete="off"> ไม่ได้สังเกต
								</label>
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
