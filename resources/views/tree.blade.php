@extends('app')

@section('content')
<script type="text/javascript" CHARSET="UTF-8">

	//var imageMen = "/imagesTest/men.png";
	//var imageWomen = "/imagesTest/women.png";
	var func_url = <?php echo $citi_id; ?>;
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
			url: '<?=URL::to('/')?>/get_tree/'+func_url,
			dataType: 'json',
			type: 'GET',

			success: function(data, textStatus, jQxhr) {

				$("#basicdiagram").treeControl({
					data: data.person
				});
			},
			error: function(data, textStatus, jQxhr) {

			},
		});
		/*$.ajax({
        url: 'http://www.cavaros.com/health_system/public/get_tree/1103300053746',
        dataType: 'jsonp',
        type: 'GET',
        jsonpCallback: "callback",
        contentType: "application/json",
        success: function(data, textStatus, jQxhr) {

          $("#basicdiagram").treeControl({
            data: data.person
          });
        },
        error: function(data, textStatus, jQxhr) {

        },
      });*/


	})
</script>


<body>
	<h3> Family Tree </h3>
	<div id="basicdiagram" style="width: auto; height: 680px; border-style: dotted; border-width: 1px;" />
</body>

@endsection