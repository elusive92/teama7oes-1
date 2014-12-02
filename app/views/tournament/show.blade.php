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

@if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

		<article>

			<p><a href=""><img src="{{ URL::asset('/') }}img/avatar_example.jpg" class="imgsize"></a></p>
			<h2> {{$tournament->name}} </h3>
			<p>Description: {{ $tournament->descript }}</p>
			<p>Rejestracja do: {{ e($tournament->regdate) }}
            <p>Start: {{ e($tournament->startdate) }}</p>
        @if(Auth::check())
            @if($tournament->status == 0 & $addteam)
                    <div class="clear"><a href="{{ URL::action('join-Tournament', $tournament->id) }}" class="btn btn-default">Join Tournament</a></div>
            @endif
        @endif

			<a href="{{ URL::route('tournaments')}}"><span><img src="{{ URL::asset('/') }}img/ico/back.png"/></span> Go back</a>
			
		</article>


@stop
