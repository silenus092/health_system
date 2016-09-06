@extends('app')

@section('content')
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css"
		  rel="stylesheet"/>
	<link href="{{ URL::asset('/scripts/css/xeditable/address.css') }}" rel="stylesheet">
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script src="{{ URL::asset('/scripts/js/xeditable/address.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/xeditable/moment.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/xeditable/combodate.js') }}"></script>
	<style>
		/*  bhoechie tab */
		div.bhoechie-tab-container {

			height: 100%;
			z-index: 10;
			background-color: #ffffff;
			padding: 0 !important;
			border-radius: 4px;
			-moz-border-radius: 4px;
			border: 1px solid #ddd;
			margin-top: 20px;
			margin-left: 50px;
			-webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
			box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
			-moz-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
			background-clip: padding-box;
			opacity: 0.97;
			filter: alpha(opacity=97);
		}

		div.bhoechie-tab-menu {
			padding-right: 0;
			padding-left: 0;
			padding-bottom: 0;
		}

		div.bhoechie-tab-menu div.list-group {
			margin-bottom: 0;
		}

		div.bhoechie-tab-menu div.list-group > a {
			margin-bottom: 0;
		}

		div.bhoechie-tab-menu div.list-group > a .glyphicon,
		div.bhoechie-tab-menu div.list-group > a .fa {
			color: #5A55A3;
		}

		div.bhoechie-tab-menu div.list-group > a:first-child {
			border-top-right-radius: 0;
			-moz-border-top-right-radius: 0;
		}

		div.bhoechie-tab-menu div.list-group > a:last-child {
			border-bottom-right-radius: 0;
			-moz-border-bottom-right-radius: 0;
		}

		div.bhoechie-tab-menu div.list-group > a.active,
		div.bhoechie-tab-menu div.list-group > a.active .glyphicon,
		div.bhoechie-tab-menu div.list-group > a.active .fa {
			background-color: #5A55A3;

			color: #ffffff;
		}

		div.bhoechie-tab-menu div.list-group > a.active:after {
			content: '';
			position: absolute;
			left: 100%;
			top: 50%;
			margin-top: -13px;
			border-left: 0;
			border-bottom: 13px solid transparent;
			border-top: 13px solid transparent;
			border-left: 10px solid #5A55A3;
		}

		div.bhoechie-tab-content {
			background-color: #ffffff;
			/* border: 1px solid #eeeeee; */
			padding-left: 20px;
			padding-top: 10px;
		}

		div.bhoechie-tab div.bhoechie-tab-content:not(.active) {
			display: none;
		}

		.status {
			font-family: 'Source Sans Pro', sans-serif;
		}

		.status .panel-title {
			font-family: 'Oswald', sans-serif;
			font-size: 30px;
			font-weight: bold;

			line-height: 15px;
			padding-top: 5px;
			letter-spacing: -0.8px;
		}

		#myPleaseWait {
			z-index: 1500;
		}

		#myModalEDIT {
			z-index: 1500;
		}
	</style>
	<script type="text/javascript" CHARSET="UTF-8">
		var person_id = "<?php echo $person->person_id; ?>";

		$(document).ready(function () {

			var panels = $('.user-infos');
			var panelsButton = $('.dropdown-user');
			panels.hide();

			$('#myModalEDIT').modal('hide');
			$.fn.editable.defaults.mode = 'popup';

			$('#date_birth').editable({
				type: 'combodate',
				pk: person_id,
				url: '{{URL::to("/")}}/update_age',
				title: 'Enter age',
				disabled: 'true',
				format: 'YYYY-MM-DD',

			});
			$('#date_birth').on('save', function (e, params) {
				var currentDate = new Date();
				var newvalue = params.newValue;
				var selectedDate = new Date(newvalue);
				var age = currentDate.getFullYear() - selectedDate.getFullYear();

				var m = currentDate.getMonth() - selectedDate.getMonth();
				if (m < 0 || (m === 0 && currentDate.getDate() < selectedDate.getDate())) {
					age--;
				}

				$('#age').text(age);
				//alert(age);

			});


			$('#sex').editable({
				type: 'select',
				pk: person_id,
				url: '{{URL::to("/")}}/update_Gender',
				title: 'Select gender',
				source: [
					{value: 'male', text: 'male'},
					{value: 'female', text: 'female'},
				],
				disabled: 'true'
			});
			/* $('#citizenID').editable({
			 type: 'text',
			 pk: person_id,
			 url: '{{URL::to("/")}}/update_CitizenID',
			 title: 'Enter Citizen ID',
			 disabled: 'true'
			 }); */

			$('#mobile_phone').editable({
				type: 'text',
				pk: person_id,
				url: '{{URL::to("/")}}/update_Mobile',
				title: 'Enter mobile phone',
				disabled: 'true'
			});
			$('#landline').editable({
				type: 'text',
				pk: person_id,
				url: '{{URL::to("/")}}/update_Landline',
				title: 'Enter landline',
				disabled: 'true'
			});
			$('#address_field').editable({
				send: 'always',
				pk: person_id,
				url: '{{URL::to("/")}}/update_address',
				title: 'Enter city, street and building #',
				value: {
					house_number: '{{ $person->person_house_num }}',
					street: '{{ $person->person_road  }}',
					soi: "{{ $person->person_soi }}",
					mooh: '{{ $person->person_mooh_num}}',
					tumbon: "{{$person->person_tumbon}}",
					amphur: "{{$person->person_amphur}}",
					province: "{{$person->person_province}}",
					post_code: "{{$person->person_post_code}}"
				},
				disabled: 'true'
			});

			var myupload = $(".uploader").upload({
				name: 'file',
				action: "{{ url('/upload_image') }}",
				enctype: 'multipart/form-data',
				params: {person_id: person_id},
				method: 'post',
				autoSubmit: true,
				onSubmit: function () {
					$('#myPleaseWait').modal('show');
				},
				onComplete: function (response) {

					var index = response.indexOf("}");
					var result;
					if (index < 0) {
						result = response;
					} else {
						result = response.substr(0, index + 1);
					}

					var obj = $.parseJSON(result);

					$('#myPleaseWait').modal('hide');
					if (obj['status'] == "Complete")
						window.location.reload(true);
					else {

						alert(obj.status);
						$.amaran({
							'theme': 'colorful',
							'content': {
								bgcolor: '#f71414',
								color: '#fff',
								message: 'Upload fail'
							},
							'position': 'top right',
							'outEffect': 'slideBottom'
						});
					}

				},
				onSelect: function () {
				}
			});


			//Click dropdown
			panelsButton.click(function () {
				//get data-for attribute
				var dataFor = $(this).attr('data-for');
				var idFor = $(dataFor);

				//current button
				var currentButton = $(this);
				idFor.slideToggle(400, function () {
					//Completed slidetoggle
					if (idFor.is(':visible')) {
						currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
					}
					else {
						currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
					}
				})
			});


			$('[data-toggle="tooltip"]').tooltip();

			$('#btn_submit').click(function (e) {
				e.preventDefault();
				var select_value = $("#select_list_report").val();

				if (select_value == -1) {
					alert("Nothing to search :-)");
				} else {
					window.location = '<?=URL::to('/')?>/show_report_by_type/' + select_value + '/' + person_id;
				}
			});

			$('#myModalEDIT_button').click(function (e) {
				e.preventDefault();
				$('#date_birth').editable('toggleDisabled');
				$('#sex').editable('toggleDisabled');
				//$('#citizenID').editable('toggleDisabled');
				$('#mobile_phone').editable('toggleDisabled');
				$('#landline').editable('toggleDisabled');
				$('#address_field').editable('toggleDisabled');
			});
		});
		function remove_person(id, name) {
			BootstrapDialog.confirm({
				title: 'WARNING',
				message: 'Do you wan to drop ' + name + ' ?',
				type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
				closable: true, // <-- Default value is false
				draggable: true, // <-- Default value is false
				btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
				btnOKLabel: 'Drop it!', // <-- Default value is 'OK',
				btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
				callback: function (result) {
					// result will be true if button was click, while it will be false if users close the dialog directly.
					if (result) {
						$.ajax({
							url: "{{ url('/drop_person') }}",
							type: "POST",
							data: "person_id=" + id,
							success: function (data) {
								//alert(data.status +" \n"+ data.message);
								if (data.status == "Success") {
									BootstrapDialog.show({
										type: BootstrapDialog.TYPE_SUCCESS,
										title: data.status,
										message: data.message + " " + name
									});
									window.location = '{{ URL::asset('/home') }}';
								} else {
									BootstrapDialog.show({
										type: BootstrapDialog.TYPE_DANGER,
										title: data.status,
										message: data.message
									});
								}
							},
							error: function (xhr, textStatus, thrownError) {
								BootstrapDialog.show({
									type: BootstrapDialog.TYPE_DANGER,
									title: textStatus,
									message: thrownError
								});
							}
						});

					} else {

					}
				}
			});

		}
	</script>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">{{ $person->person_first_name." ".  $person->person_last_name}}</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<!-- <img id="uploader" alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive "> -->
							<div class="col-md-3 col-lg-3" align="center">
								Click to upload <br>
								<?php
								if ($person->profile_img != null) {
									echo '<img class="img-circle img-responsive uploader" width="300px" height="350px" src="' . asset('../public/uploads/' . $person->profile_img) . '"><br />';
								} else {
									echo '<img class="img-circle img-responsive uploader"  alt="no_floor_image" width="300px" height="350px" src="' . asset('../public/images/no_floor_image.png') . '"><br />';
								}
								?>

							</div>

							<div class=" col-md-9 col-lg-9 ">
								<table class="table table-user-information">
									<tbody>

									<tr>
										<td>Birthday:</td>
										<td><a href="#" id="date_birth"
											   title="Select date & time">{{ $person->person_birth_date}}</a>
										<td>
									</tr>
									<tr>
										<td>Age:</td>
										<td>
											<div id="age">{{ $person->person_age}}</div>
										</td>
									</tr>
									<tr>
										<td>Status:</td>
										<td>
											<div id="age">{{ $person->person_alive}}</div>
										</td>
									</tr>
									<!-- <tr>
										<td>Citizen ID:</td>
                                        <td><a href="#" id="citizenID">{{ $person->person_citizenID}}</a></td>
									</tr> -->
									<tr>
										<td>Gender:</td>
										<td><a href="#" id="sex">{{ $person->person_sex}}</a></td>
									</tr>

									<tr>
										<td>Phone Number</td>
										<td><a href="#" id="mobile_phone">{{ $person->person_mobile_phone }} </a>
											(Mobile)<br><br><a href="#" id="landline">{{$person->person_phone }}</a>
											(Landline)
										</td>
									</tr>
									<tr>

										<td>Home Address:</td>
										<td><a href="#" id="address_field"
											   data-type="address"> {{ $person->person_house_num." ".$person->person_soi." ".$person->person_road}}
												<br>
												{{ $person->person_mooh_num." ".$person->person_tumbon." ".$person->person_amphur}}
												<br>
												{{ $person->person_province." ".$person->person_post_code}}</a>
										</td>
									</tr>
									</tbody>
								</table>

							</div>
						</div>
						<div class="panel-footer">
							<a data-original-title="View as tree diagram" data-toggle="tooltip" type="button"
							   class="btn btn-sm btn-primary"
							   href="{{route('lists.items.create', ['id' => $person->person_id ])}}"> View as family
								tree <i class="glyphicon glyphicon-tree-conifer"></i></a>
							<span class="pull-right">
							<button id="myModalEDIT_button" data-original-title="Edit this user" data-toggle="tooltip"
									type="button" class="btn btn-sm btn-warning">Enable/Disable Edit <i
										class="glyphicon glyphicon-edit"></i></button>
							<a data-original-title="Remove this user" data-toggle="tooltip" type="button"
							   onclick="remove_person('{{ $person->person_id}}','{{ $person->person_first_name." ".$person->person_last_name}}')"
							   class="btn btn-sm btn-danger">Delete <i class="glyphicon glyphicon-remove"></i></a>
						</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<h3 style="margin-top: 0;">เลือกประวัติการรักษา </h3>
			<hr class="separator">
			<div class="form-group">
				<label class="col-xs-3 control-label">ชื่อโรคที่รับการรักษา</label>
				<div class="col-xs-5 selectContainer">
					<select id="select_list_report" name="select_list_report" class="form-control">

						<?php
						if (count($results) > 0) {

							foreach ($results as $result) {
								echo "<option value='" . $result->disease_type_id . "' >" . $result->disease_type_name_en . "</option>";
							}

						} else {
							echo "<option value='-1'>ไม่มีประวัติการรักษา</option>";
						}
						?>

					</select>

				</div>
			</div>
			<button id="btn_submit" class="btn btn-primary">View</button>
		</div>
		<hr class="separator">
		<div id="show_result" class="row">
			<?php if(count($result_callback) > 0 || $result_callback != null && $result_callback_header->disease_type_id == 1) { ?>
			<a data-original-title="View as PDF" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"
			   href="{{ route('view_pdf.type', [ $person->person_id ,$result_callback_header->disease_type_id ]) }}">view
				as pdf <i class="glyphicon glyphicon-download-alt"></i></a>
			<center><h3 style="margin-top: 0;">
					ผลการรักษาโรค <?php echo " " . $result_callback_header->disease_type_name_en ?> </h3></center>
			<div class="panels panel-body">
				<form id="main_form" class="form-horizontal" role="form" method="POST">
					<input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">

					<div class="form-group">
						<label class="col-md-4 text-left">1.อาการของผู้ป่วย ณ ปัจจุบัน</label>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.1 เดินเขย่ง หลังแอ่น เดินขาปัด ล้มบ่อย </label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary">
								<input type="radio" name="1_1_symptom" id="1_1_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_1_symptom" id="1_2_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_1_symptom" id="1_3_symptom" value="ไม่ได้สังเกต"
									   autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.2 ลุกขึ้นยืนลำบากต้องเหนี่ยวจับหรือเกาะขึ้นยืน
							(ท่าโกเวอร์)</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="1_2_symptom" id="1_4_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_2_symptom" id="1_5_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_2_symptom" id="1_6_symptom" value="ไม่ได้สังเกต"
									   autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">1.3 เดินไม่ได้แล้ว</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="1_3_symptom" id="1_7_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_3_symptom" id="1_8_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="1_3_symptom" id="1_9_symptom" value="ไม่ได้สังเกต"
									   autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">2. ครั้งแรกที่เริ่มมีปัญหาการเดินหรือการลุกยืน อายุ</label>
						<div class="col-md-2">
							<input type="text" class="form-control" name="2_symptom_age" placeholder="ปี">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">3. ครั้งแรกที่เริ่มพาไปตรวจเรื่องปัญหาการเดินหรือการลุกยืน
							อายุ </label>
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
								<input type="radio" name="4_1_symptom" id="4_1_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_1_symptom" id="4_2_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.2 ลักษณะคล้ายออทิสติก</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_2_symptom" id="4_3_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_2_symptom" id="4_4_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.3 นอนกรน</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_3_symptom" id="4_5_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_3_symptom" id="4_6_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">4.4 เหนื่องง่าย หรือนอนราบไม่ได้ (ต้องใช้หมอนมากกว่า 1
							ใบ)</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="4_4_symptom" id="4_7_symptom" value="ไม่เป็น"
									   autocomplete="off" checked> ไม่เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_4_symptom" id="4_8_symptom" value="เป็น" autocomplete="off">
								เป็น
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="4_4_symptom" id="4_9_symptom" value="ไม่ได้สังเกต"
									   autocomplete="off"> ไม่ได้สังเกต
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">5. มีผลตรวจระดับเอนไซม์กล้ามเนื้อ (ซีเค creatinine kinase)
							หรือไม่</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="5_symptom" id="5_1_symptom" value="ไม่มี" autocomplete="off"
									   checked> ไม่มี
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="5_symptom" id="5_2_symptom" value="มี" autocomplete="off"> มี
							</label>
						</div>
						<p>
						<div id="5_2_symptom_add_on">
							<label class="col-md-1 ">ผล</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="5_2_symptom_add_on_result"
									   name="5_2_symptom_add_on_result" disabled="true">
							</div>
							<label class="col-md-2">ครั้งแรก เมื่อ วัน-เดือน-ปี</label>
							<div class='col-md-2 input-group date' id='datetimepicker2'>
								<input type='text' id="5_2_symptom_add_on_result_date"
									   name="5_2_symptom_add_on_result_date" class="form-control" disabled="true"/>
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
								<input type="radio" name="6_symptom" id="6_1_symptom" value="ไม่ได้ตรวจ"
									   autocomplete="off" checked> ไม่ได้ตรวจ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="6_symptom" id="6_2_symptom" value="ตรวจ" autocomplete="off">
								ตรวจ
							</label>
						</div>
						<p>
						<div id="6_2_symptom_add_on">
							<label class="col-md-1 ">ผล</label>
							<div class="col-md-4">
								<input type="text" class="form-control" id="6_2_symptom_add_on_result"
									   name="6_2_symptom_add_on_result" disabled="true">
							</div>
							<label class="col-md-2">ครั้งสุดท้าย เมื่อ วัน-เดือน-ปี</label>
							<div class='col-md-2 input-group date' id='datetimepicker3'>
								<input type='text' id="6_2_symptom_add_on_result_date"
									   name="6_2_symptom_add_on_result_date" class="form-control" disabled="true"/>
								<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
							</div>
						</div>
						</p>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">7. การตรวจยีนโรคกล้ามเนื้อเสื่อมดูเชน ของผู้ป่วย
							ด้วยวิธีต่อไปนี้และผลดังนี้ </label>
					</div>

					<div class="form-group">
						<label class="col-md-2 text-left">7.1 Multiplex PCR </label>
						<div class="col-md-3 btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="7_1_symptom" id="7_1_symptom" value="ปกติ" autocomplete="off"
									   checked> ปกติ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="7_1_symptom" id="7_2_symptom" value="ไม่ได้ตรวจ"
									   autocomplete="off"> ไม่ได้ตรวจ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="7_1_symptom" id="7_3_symptom" value="ผิดปกติ"
									   autocomplete="off"> ผิดปกติ
							</label>
						</div>
						<div class="col-md-5">
							<input type="text" class="col-md-5 form-control" name="7_1_symptom_result" placeholder="ผล">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 text-left">7.2 MLPA </label>
						<div class="col-md-3 btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="7_2_symptom" id="7_4_symptom" value="ปกติ" autocomplete="off"
									   checked> ปกติ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="7_2_symptom" id="7_5_symptom" value="ไม่ได้ตรวจ"
									   autocomplete="off"> ไม่ได้ตรวจ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="7_2_symptom" id="7_6_symptom" value="ผิดปกติ"
									   autocomplete="off"> ผิดปกติ
							</label>
						</div>
						<div class="col-md-5">
							<input type="text" class="col-md-5 form-control" name="7_2_symptom_result" placeholder="ผล">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 text-left">7.3 Sequencing</label>
						<div class="col-md-3 btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="7_3_symptom" id="7_7_symptom" value="ปกติ" autocomplete="off"
									   checked> ปกติ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="7_3_symptom" id="7_8_symptom" value="ไม่ได้ตรวจ"
									   autocomplete="off"> ไม่ได้ตรวจ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="7_3_symptom" id="7_9_symptom" value="ผิดปกติ"
									   autocomplete="off"> ผิดปกติ
							</label>
						</div>
						<div class="col-md-5">
							<input type="text" class="col-md-5 form-control" name="7_3_symptom_result" placeholder="ผล">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 text-left">8. ผลตรวจยีนของมารดา</label>
						<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="8_1_symptom" id="8_1_symptom" value="เป็นพาหะ"
									   autocomplete="off" checked> เป็นพาหะ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="8_1_symptom" id="8_2_symptom" value="ไม่เป็นพาหะ"
									   autocomplete="off"> ไม่เป็นพาหะ
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="8_1_symptom" id="8_3_symptom" value="ไม่รู้"
									   autocomplete="off">ยังไม่ได้ตรวจ / ไม่รู้
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 text-left"> 9. ผู้ป่วยมีพี่น้องแม่เดียวกันกี่คน </label>
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
						<label class="col-md-3 text-left">10. ประวัติครอบครัว มารดา </label>
					</div>
					<div class="form-group">
						<label class="col-md-5">
							10.1 มีหรือเคยมีพี่น้องเพศชาย หรือญาติเพศชายป่วยเป็นโรคกล้ามเนื้อหรือไม่
						</label>
						<div class="col-md-2 btn-group" data-toggle="buttons">
							<label class="btn btn-primary active">
								<input type="radio" name="10_symptom" id="10_1_symptom" value="ไม่มี" autocomplete="off"
									   checked> ไม่มี
							</label>
							<label class="btn btn-primary">
								<input type="radio" name="10_symptom" id="10_2_symptom" value="มี" autocomplete="off">
								มี
							</label>
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control" id="10_symptom_number" name="10_symptom_number"
								   disabled="true" placeholder="กี่คน">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-6 control-label">รายชือญาติที่ป่วยเป็นโรคกล้ามเนื้อ ระบุว่าเป็นใครบ้าง
							และอายุเท่าไหร่ พร้อมเลขที่บัตรประชาชน</label>

						<input type="button" id="add_more" value="Add More" class="btn btn-primary"/>

						<div class="checkbox col-md-2">
							<label>
								<input type="checkbox" id="10_symptom_checkbox" name="10_symptom_checkbox">ไม่รู้:
								ติดตามเพิ่มเติม
							</label>
						</div>
					</div>

					<div class="form-group form-group_10">
						<div class="col-md-2">
							<input type="text" class="form-control field_name" name="10_name[]"
								   placeholder="1-ชื่อ-นามสกุล" required="true">
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control field_age" name="10_age[]" placeholder="อายุ"
								   required="true">
						</div>
						<div class="col-md-2">
							<input type="text" class="form-control field_id" name="10_citizen_number[]"
								   placeholder="เลขประจำตัวประชาชน" required="true">
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
						<label class="col-md-3 text-left">10.2 มารดามีพี่น้องแม่เดียวกัน กี่คน </label>
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
						<div class='col-md-6'>
							<input type="text" class="form-control" name="hospital_name" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-8 control-label">แพทย์เจ้าของไข้</label>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">วัน-เดือน-ปี ที่บันทึกข้อมูลโดยแพทย์เจ้าของไข้</label>
						<div class='col-md-6 input-group date' id='datetimepicker4'>
							<input type='text' name="doctor_care_date" class="form-control" disabled/>
							<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">ชื่อ-นามสกุล</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="doctor_name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">เบอร์โทร</label>
						<div class='col-md-6'>
							<input type="text" class="form-control" name="doctor_mobilephonenumber" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">โทรสาร</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="doctor_phonenumber">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">email</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="doctor_email">
						</div>
					</div>

					<hr>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<input type="button" id="submit" value="update value" class="btn btn-primary"/>
						</div>
					</div>
				</form>

			</div>

			<?php }else if ($result_callback_header == "Error") {
				echo '<script type="text/javascript">alert(' . $result_callback . ');</script>';

			}
			?>
		</div>


	</div>


	<!--Loading Modal Start here-->
	<div class="modal fade " id="myPleaseWait" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">
                    <span class="glyphicon glyphicon-time">
                    </span>Please Wait
					</h4>
				</div>
				<div class="modal-body">
					<div class="progress">
						<div class="progress-bar progress-bar-info
                    progress-bar-striped active"
							 style="width: 100%">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal ends Here -->

@endsection
