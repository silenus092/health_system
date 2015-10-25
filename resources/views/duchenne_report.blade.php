
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
    color: #ffff;
    line-height: 15px;
    padding-top: 5px;
    letter-spacing: -0.8px;
}
</style>

<script type="text/javascript">
$(document).ready(function() {

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

});
</script>
<div id="container">
    <div class="row">
        <div class="col-md-11 bhoechie-tab-container">
            <div class="col-md-1  bhoechie-tab-menu">
                <div class="list-group">
                    <a href="#" class="list-group-item active text-center">
                        <h4 class="glyphicon glyphicon-dashboard"></h4><br/>Dashbroad
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-user"></h4><br/>ByPerson
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-home"></h4><br/>Hotel
                    </a>
                    <a href="#" class="list-group-item text-center">
                        <h4 class="glyphicon glyphicon-cutlery"></h4><br/>Restaurant
                    </a>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- Dashbroad section -->
                <div class="bhoechie-tab-content active">
                    <h3 style="margin-top: 0;">ผลตรวจยีนของผู้ป่วย</h3>
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
                <!-- ByPerson section -->
                <div class="bhoechie-tab-content">
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
                </div>

                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Hotel Directory</h3>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Restaurant Diirectory</h3>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                        <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
                        <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                        <h3 style="margin-top: 0;color:#55518a">Credit Card</h3>
                    </center>
                </div>
            </div>
        </div>
    </div>
    @endsection
