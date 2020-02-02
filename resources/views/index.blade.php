<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Sistem Pendukung Keputusan Pendirian Coffee Shop</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700,900" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="{{asset('/css/owl.carousel.css')}}" />
	<link type="text/css" rel="stylesheet" href="{{asset('/css/owl.theme.default.css')}}" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{asset('/css/style.css')}}" />
	
</head>
<body>
	
	<!-- Header -->
	<header id="header" class="transparent-navbar">
		<!-- container -->
		<div class="container">
			<!-- navbar header -->
			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a class="logo" href="index.html">
						<h1 class="logo-img" >SPKCOFFEESHOP</h1>
						<h1 class="logo-alt-img" style="color: #fff;">SPKCOFFEESHOP</h1>
						<!-- <img class="logo-img" src="./img/kkbrc-logo.png" alt="logo">
						<img class="logo-alt-img" src="./img/kkbrc-logo.png" alt="logo"> -->
					</a>
				</div>
				<!-- /Logo -->

				<!-- Mobile toggle -->
				<button class="navbar-toggle">
					<i class="fa fa-bars"></i>
				</button>
				<!-- /Mobile toggle -->
			</div>
			<!-- /navbar header -->

			<!-- Navigation -->
			<nav id="nav">
				<ul class="main-nav nav navbar-nav navbar-right">
					<li><a href="/home">Home</a></li>
			        <li><a href="/login">Login</a></li>
				</ul>
			</nav>
			<!-- /Navigation -->
		</div>
		<!-- /container -->
	</header>
	<!-- /Header -->

	<div id="home">
	<!-- Home -->
		<!-- background image -->
		<div class="section-bg" style="opacity: 0.8;background-image:url(https://static1.squarespace.com/static/58adf4d2b3db2b088cd762dc/58ae1c7cb8a79be8801a5cec/58ae1c93197aeaa55e1df500/1487805601377/blkeyelohi-8.jpg)" data-stellar-background-ratio="0.5"></div>
		<!-- /background image -->

		<!-- home wrapper -->
		<div class="home-wrapper">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- home content -->
					<div class="col-md-8 col-md-offset-2">
						<div class="home-content">
							<h1>Sistem Pendukung Keputusan Pendirian Usaha Coffee  Shop</h1>
							<h4 class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h4>
							<a href="login#signup" class="main-btn">Register</a>
						</div>
					</div>
					<!-- /home content -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /home wrapper -->
	</div>
	
	<div id="app">
		<judgesHome></judgesHome>
		<sponsorhome></sponsorhome>
		<prizehome></prizehome>	
		<footer id="footer">
			<footer-content/>
		</footer>
	</div>
	
	<!-- jQuery Plugins -->
	<script src="{{asset('/js/jquery.min.js')}}"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('/js/jquery.stellar.min.js')}}"></script>
	<script src="{{asset('/js/jquery.countTo.js')}}"></script>
	<script src="{{asset('/js/main.js')}}"></script>
	<script src="{{asset('/js/app.js')}}"></script>




</body>

</html>
