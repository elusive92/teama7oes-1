@extends('layout.main')

@section('title')
	Tournaments
@stop

@section('content')
	tournaments
	{{Cookie::get('gameid')}}

@stop