<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf_token" content="{{ csrf_token() }}" />
	<title>Laravel</title>

	<!-- CSS -->
	<link rel="stylesheet" href="{{ URL::asset('scripts/css/bootstrap.min.css') }}" >
	<link rel="stylesheet" href="{{ URL::asset('scripts/css/bootstrap-theme.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('scripts/css/bootstrap-datetimepicker.min.css') }}">
	<link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('scripts/css/bootstrap-dialog.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('scripts/css/amaran.min.css') }}" rel="stylesheet">
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!-- JS Scripts -->
	<script src="{{ URL::asset('/scripts/jquery-1.11.2.min.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script src="{{ URL::asset('/scripts/custom-loading.js') }}"></script>
	<script src="{{ URL::asset('/scripts/js/bootstrap-dialog.min.js') }}"></script>
  <script src="{{ URL::asset('/scripts/js/jquery.amaran.min.js') }}"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>A
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  <!--  Backup
  <link rel="stylesheet" href="{{ URL::asset('scripts/css/bootstrap.min.css') }}" >
  <link rel="stylesheet" href="{{ URL::asset('scripts/css/bootstrap-theme.min.css') }}">
  <link rel="stylesheet" href="{{ URL::asset('scripts/css/bootstrap-datetimepicker.min.css') }}">
  <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('scripts/css/bootstrap-dialog.min.css') }}" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
  <script src="{{ URL::asset('/scripts/jquery-1.11.2.min.js') }}"></script>
  <script src="{{ URL::asset('/scripts/js/bootstrap.min.js') }}"></script>
  <script src="{{ URL::asset('/scripts/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script src="{{ URL::asset('/scripts/custom-loading.js') }}"></script>
  <script src="{{ URL::asset('/scripts/js/bootstrap-dialog.min.js') }}"></script> -->
  <style>
  .loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('images/ajax-loader.gif') 50% 50% no-repeat rgb(249,249,249);
 }
</style>
</head>
<body>
	<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">

				<img src="<?php  echo url('images/icbslogo1.png'); ?>" alt="ICBS" style="width:300px;height:50px;">
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ URL::asset('/home') }}">Home</a></li>
					<li><a href="{{ URL::asset('/form') }}">Form</a></li>

				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ URL::asset('/auth/login') }}">Login</a></li>
						<li><a href="{{ URL::asset('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ URL::asset('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

</body>
</html>
