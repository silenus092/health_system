@extends('app')

@section('content')

<style >
	/*  bhoechie tab */
	div.bhoechie-tab-container{

		height: 100%;
		z-index: 10;
		background-color: #ffffff;
		padding: 0 !important;
		border-radius: 4px;
		-moz-border-radius: 4px;
		border:1px solid #ddd;
		margin-top: 20px;
		margin-left: 50px;
		-webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
		box-shadow: 0 6px 12px rgba(0,0,0,.175);
		-moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
		background-clip: padding-box;
		opacity: 0.97;
		filter: alpha(opacity=97);
	}
	div.bhoechie-tab-menu{
		padding-right: 0;
		padding-left: 0;
		padding-bottom: 0;
	}
	div.bhoechie-tab-menu div.list-group{
		margin-bottom: 0;
	}
	div.bhoechie-tab-menu div.list-group>a{
		margin-bottom: 0;
	}
	div.bhoechie-tab-menu div.list-group>a .glyphicon,
	div.bhoechie-tab-menu div.list-group>a .fa {
		color: #5A55A3;
	}
	div.bhoechie-tab-menu div.list-group>a:first-child{
		border-top-right-radius: 0;
		-moz-border-top-right-radius: 0;
	}
	div.bhoechie-tab-menu div.list-group>a:last-child{
		border-bottom-right-radius: 0;
		-moz-border-bottom-right-radius: 0;
	}
	div.bhoechie-tab-menu div.list-group>a.active,
	div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
	div.bhoechie-tab-menu div.list-group>a.active .fa{
		background-color: #5A55A3;
		background-image: #5A55A3;
		color: #ffffff;
	}
	div.bhoechie-tab-menu div.list-group>a.active:after{
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

	div.bhoechie-tab-content{
		background-color: #ffffff;
		/* border: 1px solid #eeeeee; */
		padding-left: 20px;
		padding-top: 10px;
	}

	div.bhoechie-tab div.bhoechie-tab-content:not(.active){
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

	$(document).ready(function() {

		var panels = $('.user-infos');
		var panelsButton = $('.dropdown-user');
		panels.hide();

        $('#myModalEDIT').modal('show');
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
			onComplete: function(response) {
				var obj =  $.parseJSON(response);
                $('#myPleaseWait').modal('hide');
				if ( obj.status == "Complete" )
					window.location.reload(true);
				else {
				
				alert(obj.status);
					$.amaran({
						'theme'     :'colorful',
						'content'   :{
							bgcolor:'#f71414',
							color:'#fff',
							message:'Upload fail'
						},
						'position'  :'top right',
						'outEffect' :'slideBottom'
					});
				}
					
			},
			onSelect: function() {
			}
		});


		//Click dropdown
		panelsButton.click(function() {
			//get data-for attribute
			var dataFor = $(this).attr('data-for');
			var idFor = $(dataFor);

			//current button
			var currentButton = $(this);
			idFor.slideToggle(400, function() {
				//Completed slidetoggle
				if(idFor.is(':visible'))
				{
					currentButton.html('<i class="glyphicon glyphicon-chevron-up text-muted"></i>');
				}
				else
				{
					currentButton.html('<i class="glyphicon glyphicon-chevron-down text-muted"></i>');
				}
			})
		});


		$('[data-toggle="tooltip"]').tooltip();

		$('#btn_submit').click(function(e) {
			e.preventDefault();
			var select_value = $("#select_list_report" ).val();

			if(select_value == -1){
				alert("Nothing to search :-)");	
			}else{
				window.location='<?=URL::to('/')?>/show_report_by_type/'+select_value+'/'+person_id;
			}
		});


	});
	function remove_person(id,name){
		BootstrapDialog.confirm({
			title: 'WARNING',
			message: 'Do you wan to drop '+name+' ?',
			type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
			closable: true, // <-- Default value is false
			draggable: true, // <-- Default value is false
			btnCancelLabel: 'Do not drop it!', // <-- Default value is 'Cancel',
			btnOKLabel: 'Drop it!', // <-- Default value is 'OK',
			btnOKClass: 'btn-warning', // <-- If you didn't specify it, dialog type will be used,
			callback: function(result) {
				// result will be true if button was click, while it will be false if users close the dialog directly.
				if(result) {
					$.ajax({
						url: "{{ url('/drop_person') }}",
						type: "POST",
						data: "person_id="+id,
						success: function(data) {
							//alert(data.status +" \n"+ data.message);
							if(data.status == "Success"){
								BootstrapDialog.show({
									type: BootstrapDialog.TYPE_SUCCESS,
									title: data.status,
									message: data.message + " " +name
								});
								window.location = '{{ URL::asset('/home') }}';
							}else{
								BootstrapDialog.show({
									type: BootstrapDialog.TYPE_DANGER,
									title: data.status,
									message: data.message
								});
							}
						},
						error: function(xhr, textStatus, thrownError) {
							BootstrapDialog.show({
								type: BootstrapDialog.TYPE_DANGER,
								title: textStatus,
								message: thrownError
							});
						}
					});

				}else {

				}
			}
		});

	}
</script>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">{{ $person->person_first_name." ".  $person->person_last_name}}</h3>
				</div>
				<div class="panel-body">
					<div class="row">
					<!-- <img id="uploader" alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive "> -->
						<div class="col-md-3 col-lg-3" align="center">  
						<?php
						if ( $person->profile_img != null ) {
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
										<td>Age:</td>
										<td>{{ $person->person_age}}</td>
									</tr>
									<tr>
										<td>Citizen ID:</td>
										<td>{{ $person->person_citizenID}}</td>
									</tr>
									<tr>
										<td>Gender:</td>
										<td>{{ $person->person_sex}}</td>
									</tr>
									<tr>

										<td>Home Address:</td>
										<td>{{ $person->person_house_num." ".$person->person_soi." ".$person->person_road}}<br>
											{{ $person->person_mooh_num." ".$person->person_tumbon." ".$person->person_amphur}}<br>
											{{ $person->person_province." ".$person->person_post_code}}
										</td>
									</tr>
									<tr>
										<td>Phone Number</td>
										<td><?php echo $person->person_mobile_phone; ?> (Mobile)<br><br><?php echo $person->person_phone; ?> (Landline)</td>
									</tr>
								</tbody>
							</table>

						</div>
					</div>
					<div class="panel-footer">
						<a data-original-title="View as tree diagram" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary" href="{{route('lists.items.create', ['id' => $person->person_id ])}}"><i class="glyphicon glyphicon-tree-conifer"></i></a>
						<span class="pull-right">
							<a href="{{ url('/underconstruct') }}" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
							<a data-original-title="Remove this user" data-toggle="tooltip" type="button"
                               onclick="remove_person('{{ $person->person_id}}','{{ $person->person_first_name." ".$person->person_last_name}}')"
                               class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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
					if(count($results)>0){

						foreach($results as $result){
							echo "<option value='".$result->disease_type_id."' >".$result->disease_type_name_en."</option>" ;
						}

					}else{
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
		<a data-original-title="View as PDF" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary" href="{{ route('view_pdf.type', [ $person->person_id ,$result_callback_header->disease_type_id ]) }}"><i class="glyphicon glyphicon-download-alt"></i></a>                
		<center><h3 style="margin-top: 0;">ผลการรักษาโรค <?php echo " ".$result_callback_header->disease_type_name_en ?> </h3>  </center>
		<div class="col-xs-6 col-md-3">
			<div class="panel status panel-info">
				<div class="panel-heading">
					<h1 class="panel-title text-center"><?php echo $result_callback[0]->symptom_1_1; ?></h1>
				</div>
				<div class="panel-body text-center">
					<strong>เดินเขย่ง หลังแอ่น เดินขาปัด ล้มบ่อย</strong>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel status panel-info">
				<div class="panel-heading">
					<h1 class="panel-title text-center"><?php echo $result_callback[0]->symptom_1_2; ?></h1>
				</div>
				<div class="panel-body text-center">
					<strong> ลุกขึ้นยืนลำบากต้องเหนี่ยวจับหรือเกาะขึ้นยืน (ท่าโกเวอร์)</strong>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel status panel-info">
				<div class="panel-heading">
					<h1 class="panel-title text-center"><?php echo $result_callback[0]->symptom_1_3; ?></h1>
				</div>
				<div class="panel-body text-center">
					<strong> เดินไม่ได้เเล้ว </strong>
				</div>
			</div>
		</div>

		<?php }else if($result_callback_header == "Error"){
	echo '<script type="text/javascript">alert('.$result_callback.');</script>';

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

<!-- Edit Modal -->
<div class="modal fade" id="myModalEDIT" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Edit form
                </h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <form role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control"
                               id="exampleInputEmail1" placeholder="Enter email"/>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control"
                               id="exampleInputPassword1" placeholder="Password"/>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"/> Check me out
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>


            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
