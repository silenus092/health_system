<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<script src="scripts/jquery-1.9.1.min.js"></script>
	<script src="scripts/jquery-ui-1.9.2.custom.min.js"></script>
	<link href="styles/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
	<!--  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
	<script src="scripts/primitives.min.js"></script>
	<script src="scripts/treeControl.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<link href="styles/primitives.latest.css" rel="stylesheet" />

	<script>
		$(document).ready(function () {

			var parents_id = [71];
			var sons_id = [];
			var spouses_id = [80];
			var relatives_id = [65, 68];
			var sex = "male";
			var age = 24;
			var first_name = "Jumong";
			var last_name = "Ranger";
			var type_of_relationship = "son";
			var person_citizenID = "1103300053222";
			var person_alive = "1";
			var person_birth_date = "1990-10-11";
			var items ={"first_name":first_name,"last_name":last_name,				"sex":"male","isSick":"","person_alive":person_alive,"type_of_relationship":type_of_relationship,
"parents_id":parents_id,"person_birth_date":person_birth_date,"age":age,
"person_citizenID":person_citizenID,"relatives_id":[],"spouses_id":[],"sons_id":[]};
			
			$.ajax({
				url: 'http://localhost/health_system/public/add_person_api',
				contentType: "application/x-www-form-urlencoded;charset=utf-8", 
				cache: false,
        		type: 'post',
        		data: {inputs: JSON.stringify(items) },
				/*data: "sex=" + sex + "&age=" + age + "&first_name=" + first_name + "&last_name=" + last_name +
					"&parents_id=" + JSON.stringify(parents_id) + "&spouses_id=" + JSON.stringify(spouses_id) +
					"&sons_id=" + JSON.stringify(sons_id) + "&relatives_id=" + JSON.stringify(relatives_id) +
					"&type_of_relationship=" + type_of_relationship + "&person_citizenID=" + person_citizenID +
					"&person_alive=" + person_alive + "&person_birth_date=" + person_birth_date,*/
				success: function (msg) {
					$('#basicdiagram').html(msg['status'] + "<br>" + msg['message']);
				},
				 error: function (xhr, ajaxOptions, thrownError) { //Add these parameters to display the required response
            console.log(xhr.status);
            console.log(xhr.responseText);
			 console.log(xhr);
      			console.log(ajaxOptions);
        			console.log(thrownError);
        }
			});

		});
	</script>
</head>

<body>
	<div id="basicdiagram" style="width: auto; height: 680px; border-style: dotted; border-width: 1px;" />
</body>

</html>