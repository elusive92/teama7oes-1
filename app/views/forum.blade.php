@extends('layout.main')

@section('title')
	Forum
@stop

@section('content')

{{Form::open(array('url' => 'upload', 'files' => true))}}
	{{Form::file('image')}}

	{{Form::submit('upload')}}
{{Form::close()}}

@stop