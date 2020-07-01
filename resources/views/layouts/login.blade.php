<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{asset('log-reg/css/style.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="home">
		<a href="{{ route('welcome') }}" id="home"><i class="fas fa-home"></i>  Home</a>
	</div>
	<img class="wave" src="log-reg/img/wave1.png">
	<div class="container">
		<div class="img">
			<img src="log-reg/img/bg6.svg">
		</div>
		<div class="login-content">
            @yield('content')
        </div>
    </div>
    <script type="text/javascript" src="{{asset('log-reg/js/main.js')}}"></script>
</body>
</html>
    