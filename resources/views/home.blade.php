
@extends('app')

@section('content')
<script>
		 /*$(function(){
				 $.amaran({
					 'theme'     :'awesome ok',
					 'content'   :{
					title:'Welcome !!',
					message:'You are successfully logged in!',
					info:'',
					icon:'fa fa-check-square-o'
			},
				'position'          :'top right',
       	'inEffect'  :'slideTop',
				'delay' : 4000
				 });
		 });*/
 </script>
<div class="container">
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
                     
        <div class="typeahead-field">
            <span class="typeahead-query">
                <input id="search_patient" class="form-control" name="search_patient" type="search" placeholder="Search" autocomplete="off">
            </span>
            <span class="typeahead-button">
                <button type="submit">
                    <i class="typeahead-search-icon"></i>
                </button>
            </span>
        </div>
    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
