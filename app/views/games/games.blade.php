@extends('layout.main')

@section('title')

@stop

@section('content')
<head>
	<title>Kołek czasem cos robi</title>

	<!-- load bootstrap -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<style>
		body 	{ padding-bottom:40px; padding-top:40px; }
	</style>
</head>
 @if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
 @endif
 @if($errors->has('gamename'))
 <p class="alert alert-info">{{$errors->first('gamename')}}</p>
 @endif
 @if($errors->has('descript'))
  <p class="alert alert-info">{{$errors->first('descript')}}</p>
  @endif
<body class="container">

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">

		<div class="page-header">
			<h1><span></span>Add Game</h1>
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



</div>
</div>





@stop