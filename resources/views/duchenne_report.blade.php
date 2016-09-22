
@extends('app')

@section('content')
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/highcharts-3d.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
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
		color: #ffff;
		line-height: 15px;
		padding-top: 5px;
		letter-spacing: -0.8px;
	}

    #myModal_Echocardiogram {
        z-index: 1500;
    }

    #myModal_CK {
        z-index: 1500;
    }
</style>

<script type="text/javascript">
	var datas = "" ;

	$(document).ready(function() {
        $('#myModal_Echocardiogram').modal('hide');
        $('#myModal_CK').modal('hide');
        $('#popup_ck_no_result').click(function () {

            $('#myModal_CK').modal('show');
        });
        $('#popup_Echocardiogram_no_result').click(function () {

            $('#myModal_Echocardiogram').modal('show');
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
						url: "{{ url('/show_patient_duchenne') }}",
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

		$("#grid-basic").bootgrid();
		$("#grid-basic-1").bootgrid();
		$("#grid-basic-2").bootgrid();
		$('#PCR').highcharts({
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: 0,
				plotShadow: false
			},
			title: {
				text: 'Browser<br>shares<br>2015',
				align: 'center',
				verticalAlign: 'middle',
				y: 40
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					dataLabels: {
						enabled: true,
						distance: -50,
						style: {
							fontWeight: 'bold',
							color: 'white',
							textShadow: '0px 1px 2px black'
						}
					},
					startAngle: -90,
					endAngle: 90,
					center: ['50%', '75%']
				}
			},
			series: [{
				type: 'pie',
				name: 'Browser share',
				innerSize: '50%',
				data: [
					['Firefox',   10.38],
					['IE',       56.33],
					['Chrome', 24.03],
					['Safari',    4.77],
					['Opera',     0.91],
					{
						name: 'Proprietary or Undetectable',
						y: 0.2,
						dataLabels: {
							enabled: false
						}
					}
				]
			}]
		});

		$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
			e.preventDefault();
			$(this).siblings('a.active').removeClass("active");
			$(this).addClass("active");
			var index = $(this).index();
			$("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
			$("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
		});

		// Load the fonts
		Highcharts.createElement('link', {
			href: 'https://fonts.googleapis.com/css?family=Signika:400,700',
			rel: 'stylesheet',
			type: 'text/css'
		}, null, document.getElementsByTagName('head')[0]);

// Add the background image to the container
		Highcharts.wrap(Highcharts.Chart.prototype, 'getContainer', function (proceed) {
			proceed.call(this);
			this.container.style.background = 'url(http://www.highcharts.com/samples/graphics/sand.png)';
		});


		Highcharts.theme = {
			colors: ["#f45b5b", "#8085e9", "#8d4654", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
				"#55BF3B", "#DF5353", "#7798BF", "#aaeeee"],
			chart: {
				backgroundColor: null,
				style: {
					fontFamily: "Signika, serif"
				}
			},
			title: {
				style: {
					color: 'black',
					fontSize: '16px',
					fontWeight: 'bold'
				}
			},
			subtitle: {
				style: {
					color: 'black'
				}
			},
			tooltip: {
				borderWidth: 0
			},
			legend: {
				itemStyle: {
					fontWeight: 'bold',
					fontSize: '13px'
				}
			},
			xAxis: {
				labels: {
					style: {
						color: '#6e6e70'
					}
				}
			},
			yAxis: {
				labels: {
					style: {
						color: '#6e6e70'
					}
				}
			},
			plotOptions: {
				series: {
					shadow: true
				},
				candlestick: {
					lineColor: '#404048'
				},
				map: {
					shadow: false
				}
			},

			// Highstock specific
			navigator: {
				xAxis: {
					gridLineColor: '#D0D0D8'
				}
			},
			rangeSelector: {
				buttonTheme: {
					fill: 'white',
					stroke: '#C0C0C8',
					'stroke-width': 1,
					states: {
						select: {
							fill: '#D0D0D8'
						}
					}
				}
			},
			scrollbar: {
				trackBorderColor: '#C0C0C8'
			},

			// General
			background2: '#E0E0E8'

		};
		// Apply the theme
		Highcharts.setOptions(Highcharts.theme);

		$('#container_bar').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text:  'จำนวนที่คนที่ป่วยเเยกตามช่วงอายุของการป่วย'
			},
			subtitle: {
				text: ''
			},
			xAxis: {

				crosshair: true,
				title: {
					text: 'ช่วงอายุที่ป่วย'
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'จำนวนคน'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">อายุ</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
				'<td style="padding:0"><b>{point.y} คน</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: '0-5',
				data: [49]

			}, {
				name: '5-10',
				data: [83]

			}, {
				name: '10+',
				data: [48]

			}]
		});
	});
</script>
<div id="container">

	<center><h2 style="margin-top: 0;">Duchenne Report</h2></center>
	<div class="row">
		<div class="col-md-11 bhoechie-tab-container">
			<div class="col-md-2  bhoechie-tab-menu">
				<div class="list-group">
					<a href="#" class="list-group-item active text-center">
						<h4 class="glyphicon glyphicon-dashboard"></h4><br/>Dashbroad
					</a>
					<a href="#" class="list-group-item text-center">
						<h4 class="glyphicon glyphicon-home"></h4><br/>Echocardiogram and CK
					</a>
					<a href="#" class="list-group-item text-center">
						<h4 class="glyphicon glyphicon-user"></h4><br/>ByPerson
					</a>
					<a href="#" class="list-group-item text-center">
						<h4 class="glyphicon glyphicon-heart"></h4><br/>Hospital
					</a>
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
				<!-- Dashbroad section -->
				<div class="bhoechie-tab-content active">
					<center><h3 style="margin-top: 0;">จากผู้ป่วย Duchenne ในฐานข้อมูล</h3></center>
					<div class = "row">


						<div id="container_bar" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


					</div>
					<hr class="separator">
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Duchenne_total[0]->total ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนผู้ป่วย</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Family_total[0]->total ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนครอบครัวที่มีผู้ป่วยอยู่</strong>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Attention_Deficit_Disorder[0]->disorder ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>สมาธิสั้น</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Autistic[0]->disorder ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>ลักษณะคล้ายออทิสติก</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Tired[0]->disorder ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>เหนื่อยง่ายนอนราบไม่ได้</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Snorring[0]->disorder ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>นอนกรน</strong>
								</div>
							</div>
						</div>
					</div>

					<center><h3 style="margin-top: 0;">ครั้งแรกที่เริ่มมีอาการ อายุ</h3></center>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Symp2_mean[0]->mean,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Mean</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Symp2_SD[0]->sd ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>SD</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Symp2_median[0]->median_val ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Median</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Symp2_range[0]->Min." - ".$Symp2_range[0]->Max; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Range(Min - Max)</strong>
								</div>
							</div>
						</div>
					</div>

					<center><h3 style="margin-top: 0;">ครั้งแรกที่ไปหาหมอด้วยปัญหาอ่อนแรง อายุ</h3></center>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Symp3_mean[0]->mean,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Mean</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Symp3_SD[0]->sd ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>SD</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Symp3_median[0]->median_val ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Median</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Symp3_range[0]->Min." - ".$Symp3_range[0]->Max; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Range(Min - Max)</strong>
								</div>
							</div>
						</div>
					</div>
					
					<h3 style="margin-top: 0;">ผลตรวจยีนของผู้ป่วยทั้งหมด</h3>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-danger">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $DontTakeTreatment[0]->total_not_treatment ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>ไม่ได้ตรวจเลย</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-warning">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $TakeAnyTreatment[0]->total_any_treatment ; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>ได้ตรวจโดยวิธีใดวิธีหนึ่ง</strong>
								</div>
							</div>
						</div>
					</div>

					<h3 style="margin-top: 0;">ตรวจ Multiple PCR</h3>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $PCR[0]->total; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนที่ตรวจทั้งหมด</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-danger">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $PCR[0]->abnormal; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>ผิดปกติ</strong>
								</div>
							</div>
						</div>
					</div>

					<h3 style="margin-top: 0;">ตรวจ MLPA </h3>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $MLPA[0]->total; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนที่ตรวจทั้งหมด</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-danger">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $MLPA[0]->abnormal; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>ผิดปกติ</strong>
								</div>
							</div>
						</div>
					</div>

					<h3 style="margin-top: 0;">ตรวจ Sequencing </h3>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Sequencing[0]->total; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนที่ตรวจทั้งหมด</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-danger">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Sequencing[0]->abnormal; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>ผิดปกติ</strong>
								</div>
							</div>
						</div>
					</div>


				</div>

				<!-- Echocardiogram & Ck search -->
				<div class="bhoechie-tab-content">
					<center><h3 style="margin-top: 0;">Echocardiogram</h3></center>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Echocardiogram[0]->tested; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนคนที่ตรวจ</strong>
								</div>
							</div>
						</div>
                        <div id="popup_Echocardiogram_no_result" class="col-xs-6 col-md-3">
                            <div onmouseover="this.style.background='gray';" onmouseout="this.style.background='white'"
                                 style="cursor: pointer;" class="panel status panel-danger">
                                <div class="panel-heading">
                                    <h1 class="panel-title text-center"><?php echo $UnEchocardiogram[0]->un_test; ?></h1>
                                </div>
                                <div class="panel-body text-center">
                                    <strong>จำนวนคนที่ไม่ได้ตรวจ</strong>
                                </div>
								</div>

						</div>
					</div>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Echo_mean[0]->mean,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Mean</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Echo_SD[0]->sd ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>SD</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($Echo_median[0]->median_val ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Median</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Echo_range[0]->Min." - ".$Echo_range[0]->Max; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Range(Min - Max)</strong>
								</div>
							</div>
						</div>
					</div>


					<hr class="separator">

					<center><h3 style="margin-top: 0;">Creatinine Kinase</h3></center>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $Ck[0]->tested; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนที่ตรวจทั้งหมด</strong>
								</div>
							</div>
						</div>
                        <div id="popup_ck_no_result" class="col-xs-6 col-md-3">
                            <div onmouseover="this.style.background='gray';" onmouseout="this.style.background='white'"
                                 style="cursor: pointer;" class="panel status panel-danger">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $UnCk[0]->un_test; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>จำนวนคนที่ไม่ได้ตรวจ</strong>
								</div>
							</div>
						</div>

					</div>
					<div class="row" >
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($CK_mean[0]->mean,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Mean</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($CK_SD[0]->sd ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>SD</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo number_format($CK_median[0]->median_val ,2); ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Median</strong>
								</div>
							</div>
						</div>
						<div class="col-xs-6 col-md-3">
							<div class="panel status panel-info">
								<div class="panel-heading">
									<h1 class="panel-title text-center"><?php echo $CK_range[0]->Min." - ".$CK_range[0]->Max; ?></h1>
								</div>
								<div class="panel-body text-center">
									<strong>Range(Min - Max)</strong>
								</div>
							</div>
						</div>

					</div>

                </div>
				<!-- ByPerson section -->
				<div class="bhoechie-tab-content">
					<center><h3 style="margin-top: 0;">ค้นหารายชื่อผู้ป่วยโรค Duchenne </h3></center>
					<form action="{{ url('/show_person')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
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
				<div class="bhoechie-tab-content">
					<center>
						<h3 style="margin-top: 0;">จำนวนผู้ป่วยในโรงพยาบาล</h3>
					</center>
					<table id="grid-basic-2" class="table table-condensed table-hover table-striped">
						<thead>
							<tr>

								<th data-column-id="name_hospital">ชื่อโรงพยาบาล</th>
								<th data-column-id="hospital_number">จำนวนคน</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($hospital as $noresult): ?>
							<tr>

								<td><?php echo $noresult->hospital ?></td>
								<td><?php echo $noresult->total ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
	</div>


    <!-- Echocardiogram Modal -->
    <div class="modal fade" id="myModal_Echocardiogram" tabindex="-1" role="dialog"
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
                        คนที่ไม่มีผลตรวจ Echocardiogram
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <table id="grid-basic" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric">ID</th>
                            <th data-column-id="name">ชื่อ นามสกุล</th>
                            <th data-column-id="sex">เพศ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($Echocardiogram_noresult as $noresult): ?>
                        <tr>
                            <td><?php echo $noresult->person_id ?></td>
                            <td><?php echo $noresult->person_first_name . " " . $noresult->person_last_name ?></td>
                            <td><?php echo $noresult->person_sex ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <!-- Echocardiogram Modal -->
    <div class="modal fade" id="myModal_CK" tabindex="-1" role="dialog"
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
                        คนที่ไม่มีผลตรวจ Creatinine Kinase
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">


                    <table id="grid-basic-1" class="table table-condensed table-hover table-striped">
                        <thead>
                        <tr>
                            <th data-column-id="id_1" data-type="numeric">ID</th>
                            <th data-column-id="name_1">ชื่อ นามสกุล</th>
                            <th data-column-id="sex_1">เพศ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($Ck_noresult as $noresult): ?>
                        <tr>
                            <td><?php echo $noresult->person_id ?></td>
                            <td><?php echo $noresult->person_first_name . " " . $noresult->person_last_name ?></td>
                            <td><?php echo $noresult->person_sex ?></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

</div>


	@endsection
