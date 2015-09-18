
@extends('app')

@section('content')
<script>
		 $(function(){
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
		 });
 </script>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
