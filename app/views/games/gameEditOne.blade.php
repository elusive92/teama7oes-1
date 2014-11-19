@extends('layout.main')


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
 @if($errors->has('descript'))
  <p class="alert alert-info">{{$errors->first('descript')}}</p>
  @endif
<body class="container">

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">

		<div class="page-header">
			<h1><span></span>Game Editor</h1>
		</div>

		<!-- FORM STARTS HERE -->
		@if($game)
		<div class='form'>
                   {{Form::open(array(URL::route('edit-game-post',$game->id), 'files'=>true ))}}
                    <div>
                       <p>Description:</p>
                        {{Form::textarea('descript')}}
                     </div>
                     {{Form::hidden('id', $game->id)}}
                     <div class="form-group">
                        Logo: {{Form::file('logo')}}
                     </div>

                      <input type="submit" value="Create" class="btn btn-default"/>
                    {{Form::close()}}
        	</div>
        	<br>
        	<a href ="{{URL::route('edit-game')}}" class="btn btn-default">Back</a>

        @endif
</div>
</div>

@stop