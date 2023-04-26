<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<title>Student-App</title>
	<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
	<nav class="navbar navbar-expand-md bg-dark shadow-sm">
		<div class="col-md-10 navbar-brand text-light"><a class="text-light" href="{{ url('/students/') }}"><i 	class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp;University of Oxfords Online College
			</a>
		</div>

		<div class="col-md-2 d-flex flex-row justify-content-start">
			<a href=""><i class="fa fa-facebook fa-lg text-primary mr-4"></i></a>
			<a href="http://twitter.com"><i class="fa fa-twitter fa-lg text-info mr-4"></i></a>
			<a href="#"><i class="fa fa-instagram fa-lg text-light mr-4"></i></a>
			<a href="http://pinterest.com"><i class="fa fa-pinterest fa-lg text-light"></i></a>
		</div>
	</nav>

	<div class="container">
		@yield('content')
	</div>
	<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>