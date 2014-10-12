<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>League Of Legends Community</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        @include('layout.includes')
        
</head>

<body>
<div id="container">
@include('layout.navigation')

<div class="panel panel-default">
<div class="panel-body">

@include('layout.popuplogin')
  
@include('layout.popupcreate')

@if(Session::has('global'))
	<p>{{ Session::get('global') }}</p>
@endif

@yield('content')



</div>
</div>

@include('layout.footer')
    
    
    
    
    
</div>
</body>
</html>