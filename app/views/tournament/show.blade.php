@extends('layout.main')

@section('title')
	{{$tournament->name}}
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li><a href="{{ URL::route('tournaments')}}">Tournament</a></li>
      <li>{{Str::limit($tournament->name, 50)}}</li>
</ol>

		<article>
			<p><a href=""><img src="{{ URL::asset('/') }}img/avatar_example.jpg" class="imgsize"></a></p>
			<h3> {{$tournament->name}} </h3>
			<p> {{ $tournament->descript }}</p>
			<a href="{{ URL::route('tournaments')}}"><span><img src="{{ URL::asset('/') }}img/ico/back.png"/></span> Go back</a>
			
		</article>


@stop
