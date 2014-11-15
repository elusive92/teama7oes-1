@extends('layout.main')

@section('title')
	Search
@stop

@section('content')
{{Cookie::get('gameid')}}
@stop