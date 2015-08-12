
@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>
				
				<div class="panel-body">
					<?php  echo url('scripts/jquery-1.11.2.min.js'); ?>
					You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
