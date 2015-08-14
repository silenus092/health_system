
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
                <input type="email" class="form-control" name="id_citizen" >
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
