<!DOCTYPE html>
<html>
	<head>
		<title> @yield('title') | Teama7oes </title>
		<link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css')}}" />
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.png" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"> </script>
    <script type="text/javascript" src="js/script.js"></script>
    <style>
      body {background-image: url('img/games/pika.jpg')}
     /* potrzebna metoda, ktora w zaleznosci od wybranej gry ustawia background-image */
    </style>

	</head>
	<body>
    @include('layouts.navtop')
    @include('layouts.navmain')

  @include('accounts.popuplogin')
  @include('accounts.popupcreate')

   		<div class="main-box">
   			@yield('content')
   		</div>

	   	<footer>
	        <div id="footer">
	                <div class="text-center">
	                    <p>Copyright &copy; 2014</p>
	                </div>
	        </div>
   		</footer>
    <!--pokasowac script, dodac include do oddzielnego pliku z css, js -->
		<script src="js/jQuery.js"></script>
 		<script src="js/bootstrap.min.js"></script>
	</body>
</html>