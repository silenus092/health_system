
@extends('app')

@section('content')
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>


<script type="text/javascript" CHARSET="UTF-8">
	$(function(){

		function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays*24*60*60*1000));
			var expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + "; " + expires;
		}

		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}

		function checkCookie() {
			var user = getCookie("username");
			if (user != "") {
				$.amaran({
					'theme'     :'user green',
					'content'   :{
						user:'Welcome Again!!',
						message: user,
						info:'',
						img:'{{ URL::asset('images/ICBS.png') }}',
					},
					'position'  :'top right',
					'inEffect'  :'slideTop',
					'delay' : 4000
				});
			} else {
				user ='{{ \Auth::user()->name}}';
			if (user != "" && user != null) {
				setCookie("username", user, 0.5);
			}
			$.amaran({
				'theme'     :'user green',
				'content'   :{
					user:'Welcome !!',
					message:'You are successfully logged in!',
					info:'',
					img:'{{ URL::asset('images/ICBS.png') }}',
				},
				'position'  :'top right',
				'inEffect'  :'slideTop',
				'delay' : 4000
			});
		}
	}

	  checkCookie();


		$('#container_PIE').highcharts({
			chart: {
				type: 'pie',
				options3d: {
					enabled: true,
					alpha: 45
				}
			},
			title: {
				text: 'จำนวนโรคเเละผู้ป่วยที่เป็นโรคทั้งหมดในฐานข้อมูล'
			},
			subtitle: {
				text: ''
			},

            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    innerSize: 100,
                    depth: 45,
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
			series: [{
				name: 'amount',
				data: [<?php echo join($disease_summary, ","); ?>
                ]
			}]
		});


	});
	var datas = "" ;
	$(document).ready(function() {

		$('#formid').on('keyup keypress', function(e) {
			var code = e.keyCode || e.which;
			if (code == 13) { 
				e.preventDefault();
				return false;
			}
		});

		$('#search_patient-query').typeahead({
			order: "desc",
			minLength: 1,
			hint: true,

			correlativeTemplate: true,
			source: {
				person: {
					url: {
						type: "get",
						url: "{{ url('/persons_index') }}",
					}
				}
			},
			callback: {
				onClickAfter: function (node, a, item, event) {
				},
				onResult: function (node, query, obj, objCount) {

					var text = "";
					if (query !== "") {
						text = objCount + ' elements matching "' + query + '"';

					}else {
						text ="";
					}
					$('#result-container').text(text);

				},
				fail: function (jqXHR, textStatus, errorThrown) {
					alert("Cannot Search this time");
				},


			}
		});
	});
</script>
<div class="container" >
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>
				<div class="panel-body">

					@if (Session::has('message'))
					{!! Amaran::theme('user green')->content([
					'message'=>Session::get('message'),
					'user'=>' ICBS',
					'img'=>URL::asset('images/ICBS.png'),
					])
					->position('top right')
					->inEffect('slideTop')
					->create();
					!!}
					@endif
					<var id="result-container" class="result-container"></var>
					<form id="formid" action="{{ url('/show_person')}}" method="post">
						<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
						<div class="typeahead-container">
							<div class="typeahead-field">
								<span class="typeahead-query">
									<input id="search_patient-query"  name="search_patient-query" type="search" placeholder="Search (ชื่อ,นามสกุล,บัตรประชาชน)" autocomplete="off">
								</span>
								<span class="typeahead-button">
									<button type="submit" class="btn btn-primary" >
										<i class="typeahead-search-icon"></i>
									</button>
								</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Panel</div>
				<div class="panel-body">
					<div id="container_PIE" style="height: 400px">


					</div>

				</div>
			</div>
		</div>
	</div>


</div>

@endsection
