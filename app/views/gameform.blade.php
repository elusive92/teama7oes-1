@extends('layout.main')
@section('content')
<!doctype html>
<html>
<head>
	<title>Kołek czasem cos robi</title>

	<!-- load bootstrap -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<style>
		body 	{ padding-bottom:40px; padding-top:40px; }
	</style>
</head>
<body class="container">

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">

		<div class="page-header">
			<h1><span class="glyphicon glyphicon-flash"></span> Game Adder!</h1>
		</div>

		<!-- FORM STARTS HERE -->
		<div class='form'>
           {{Form::open(array(URL::route('postAddGame'), 'files'=>true ))}}


            <div class="form-group">
                Game Name: {{Form::text('gamename')}}</div>
             <div class="form-group">
                Description: {{Form::text('descript')}}
             </div>
             <div class="form-group">
                Logo: {{Form::file('logo')}}
             </div>
              <input type="submit" value="Create" class="btn btn-default"/>
            {{Form::close()}}
	</div>
</div></div>

</body>
</html>
@stop