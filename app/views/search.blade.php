@extends('layout.main')

@section('title')
	Search
@stop

@section('content')
	<div class="sep"></div>Team Search<div class="sep"></div>
	<a href="{{ URL::route('teamsearch')}}" class="btn btn-default">Team name</a>
    <div class="sep"></div>User Search<div class="sep"></div>
    <a href="#" class="btn btn-default">Username</a>
	
	</br></br>test
	{{Form::open(array('url' =>'search-user'))}}
		{{Form::text('keyword', null, array('placeholder'=> 'Search User'))}}
		{{Form::submit('Search')}}
	{{Form::close()}}
	
@stop