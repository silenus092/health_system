@extends('app')

@section('content')
	<script src="{{ URL::asset('/scripts/js/primitives.min.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/jqGlobal.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/treeControl.js') }}"></script>
	<script src="{{ URL::asset('scripts/js/jquery.blockUI.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/view.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/json_parse.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/jquery.uniform.min.js') }}"></script>

	<script type="text/javascript" CHARSET="UTF-8">

	//var imageMen = "/imagesTest/men.png";
	//var imageWomen = "/imagesTest/women.png";
	var person_id = <?php echo $citi_id; ?>;
	var colorSick = primitives.common.Colors.Orange;
	var colorWomen = primitives.common.Colors.Pink;
	var items = null;
	$(document).ready(function() {
		jQuery(document).ajaxStart(function () {
			//show ajax indicator
			ajaxindicatorstart(' Constuct Tree, please wait ....');
		}).ajaxStop(function () {
			//hide ajax indicator
			ajaxindicatorstop(' Finalize Tree .....');
		});
		$.ajax({
			//url: 'http://www.cavaros.com/health_system/public/get_tree/'+func_url,
			url: '<?=URL::to('/')?>/get_tree_api/' + person_id,
			dataType: 'json',
			type: 'GET',

			success: function(data, textStatus, jQxhr) {

				$("#basicdiagram").treeControl({
					url: 'http://www.cavaros.com/health_system/public',
					mainId: person_id,
					mainReId: person_id,
					data: data.person,
					onCancelPersonDetail: function () {
						$.unblockUI();
					},
					onOkPersonDetail: function (obj) {
						$("#basicdiagram").reCreate(obj);
						$.unblockUI();
					},
					/*onReturnPage: function () {
                        //alert("ย้อนกลับ");
                        parent.history.back();
                        return false;
                    }*/
				});

				//$uniformed = $("#btnReturn,#btnUndoDelete").not(".skipThese");
				//$uniformed.uniform();
				//$("#uniform-btnReturn").css("position", "fixed");
			},
			error: function(data, textStatus, jQxhr) {

			},

		});
        $("#btnReturn").click(function (e) {
            e.preventDefault();
            parent.history.back();
            return false;
        });

        $("#btnUndoDelete").click(function (e) {
            $.ajax({
                url: '<?=URL::to('/')?>'+ '/undo_state',
                contentType: "application/x-www-form-urlencoded;charset=utf-8",
                cache: false,
                type: 'get',
                success: function (msg) {
                    //$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);

                    // ถ้า save ผ่านสร้าง
                    if (msg['status'].toUpperCase() == 'success'.toUpperCase()) {
                        reRender();
                    }
                    else {
                        alert("ไม่สามารถบันทึกได้");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
                    alert("พบปัญหาตอนบันทึก" + " Status: " + xhr.status + " responseText: " + xhr.responseText);
                }
            });
        });


	});
	function reRender() {
		$.ajax({
			url: '<?=URL::to('/')?>/get_tree_api/' + person_id,
			dataType: 'json',
			type: 'GET',
			success: function (data, textStatus, jQxhr) {

				$('#basicdiagram').famDiagram({
					items: data.person
				});
				$('#basicdiagram').famDiagram("update", /*Refresh: use fast refresh to update chart*/ primitives.orgdiagram.UpdateMode.Recreate);
			},
			error: function (data, textStatus, jQxhr) {
				alertServiceErr(xhr);
			},
		});

		callCheckUndoDelete();
	}

	function callCheckUndoDelete() {
		$.ajax({
			url: "http://www.cavaros.com/health_system/public/check_undo_state",
			contentType: "application/x-www-form-urlencoded;charset=utf-8",
			cache: false,
			type: 'get',
			success: function (msg) {
				if (msg['status'].toUpperCase() == 'TRUE'.toUpperCase()) {
					$("#divUndoDelelte").fadeIn("fast");
				}
				else {
					$("#divUndoDelelte").fadeOut("fast");
				}
			},
			error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
				alertServiceErr(xhr);
			}
		});
	}
</script>
<style>
	.transparent {
		background:#7f7f7f;
		background:rgba(255,255,255,0.5);
	}
</style>
<body>
<div style="position:fixed;z-index:1000;top: 115px;">
    <div>
        <input id="btnReturn" type="button" class="btn btn-primary" value="ย้อนกลับ" style=" width:120px; position:relative;" /></div>
    <div id="divUndoDelelte" style="margin-top: 10px; left:150px;">
        <input id="btnUndoDelete" class="btn btn-primary"  type="button" value="ยกเลิกการลบ" style="width:120px; position:relative;"/>
    </div>
</div>

		<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default" style="width:200px; height: 200px">
				<div class="panel-heading"><h5> Family Tree </h5></div>
				<div class="panel-body">
					<div id="container_summary" >


					</div>

				</div>
			</div>
		</div>
		</div>
	<div id="basicdiagram" class="transparent" style=" background-image: url({{ URL::asset('/images/transparent_grid.png') }}) ; width: auto;  height:100vh; border-style: dotted; border-width: 1px;">


	</div>
</body>

@endsection