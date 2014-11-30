<!DOCTYPE html>
<html>
	<head>
		<title> @yield('title') | Teama7oes </title>
		<meta name="_token" content="{{ csrf_token() }}"/>
		<link rel="stylesheet" href="{{ URL::asset('/') }}css/blueimp-gallery.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('/') }}css/style.css" />
		<link rel="stylesheet" href="{{ URL::asset('/') }}css/bootstrap.css" />
		<link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('/') }}img/fav.png" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"> </script>
    <script type="text/javascript" src="{{ URL::asset('/') }}js/popup.js"></script>
    <script src="{{ URL::asset('/') }}js/jQuery.js"></script>
    <script src="{{ URL::asset('/') }}js/bootstrap.min.js"></script>
    <style>
      body {background-image: url('{{ URL::asset('/') }}img/games/bg2.jpg')}
     /* potrzebna metoda, ktora w zaleznosci od wybranej gry ustawia background-image */
    </style>

	</head>
	<body>
    @include('layout.navtop')

    <img class="logo_main" src="{{ URL::asset('/') }}img/logo_main.png" alt="Tema7oes" height="200" width="750">
    @include('layout.navmain')
 	@include('layout.popuplogin')
 	@include('layout.popupcreate')

   		<div class="main-box">
   			@yield('content')
   		</div>


    <!--pokasowac script, dodac include do oddzielnego pliku z css, js -->

	</body>
</html>