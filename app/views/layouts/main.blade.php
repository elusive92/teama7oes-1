<!DOCTYPE html>
<html>
	<head>
		<title> @yield('title') | Teama7oes </title>
		<link rel="stylesheet" href="{{ URL::asset('css/style.css')}}" />
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css')}}" />
		<link rel="shortcut icon" type="image/x-icon" href="img/fav.png" />
    <style>
      body {background-image: url('img/games/leagueoflegends.jpg')}
     /* potrzebna metoda, ktora w zaleznosci od wybranej gry ustawia background-image */
    </style>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<a class="navbar-brand" href="#"><img class="logo" src="img/nav_logo.png" alt="Tema7oes" height="25" width="160"></a>
            </div>
 			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    				<ul class="nav navbar-nav pull-right nav_right">
		                <!-- tak jak w navigation.blade.php dodac co widac przed a co po zalogowaniu-->
	                	<li>
	                        <a href="#">Sign In</a>
	                    </li>
						<li>
	                        <a href="#">Register</a>
	                    </li>
					</ul>
 			</div>
		</nav>

 		<div class="container">
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Home</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
              <ul class="nav navbar-nav">
                <li><a href="#">Teams</a></li>
                <!-- <li class="active"> dodac potem-->
                <li><a href="#">Tournaments</a></li>
                <li><a href="#">Search</a></li>
                <li><a href="#">Forum</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Games <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">League of Legends</a></li>
                    <li><a href="#">CS:GO</a></li>
                    <li class="divider"></li>
                    <li><a href="#">WoT</a></li>
                    <li><a href="#">CS 1.6</a></li>
                    <li><a href="#">Fifa2014</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
   		</div>

   		<div class="przyklad">
   			@yield('glowna')
   		</div>

		{{--@include('layouts.navigation')--}}
		
		<footer>
	        <div id="footer">
	                <div class="text-center">
	                    <p>Copyright &copy; 2014</p>
	                </div>
	        </div>
   		</footer>

		<script src="js/jQuery.js"></script>
   		<script src="js/bootstrap.min.js"></script>
	</body>
</html>