@extends('layout.main')

@section('title')
	Search
@stop

@section('content')
	<a href="{{ URL::route('teamsearch')}}" class="btn btn-default">Search teams</a>
	<a href="" class="btn btn-default">Search users</a>
@stop