@extends('app')

@section('content')
<script type="text/javascript" CHARSET="UTF-8">
$(document).ready(function() {
    var panels = $('.user-infos');
    var panelsButton = $('.dropdown-user');
    panels.hide();

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

    $('button').click(function(e) {
        e.preventDefault();
        alert("This is a demo.\n :-)");
    });
});

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
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>

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
                    <a data-original-title="View as tree diagram" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-tree-conifer"></i></a>
                    <span class="pull-right">
                        <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                        <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
    <h3 style="margin-top: 0;">ประวัติการรักษา</h3>
        <hr class="separator">
    <ul class="nav nav-tabs">
       <li><a data-toggle="tab" href="#home">Home</a></li>
       <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
       <li><a data-toggle="tab"  href="#menu2">Menu 2</a></li>
       <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
     </ul>
     <div class="tab-content">
       <div id="home" class="tab-pane fade in active">
         <h3>HOME</h3>
         <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
       </div>
       <div id="menu1" class="tab-pane fade">
         <h3>Menu 1</h3>
         <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
       </div>
       <div id="menu2" class="tab-pane fade">
         <h3>Menu 2</h3>
         <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
       </div>
       <div id="menu3" class="tab-pane fade">
         <h3>Menu 3</h3>
         <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
       </div>
     </div>
    </div>
</div>
@endsection
