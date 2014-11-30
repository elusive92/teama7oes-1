@extends('layout.main')

@section('title')
	Forum
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li>Forum</li>
</ol>

{{Form::open(array('url' => 'upload', 'files' => true))}}
	{{Form::file('image')}}

	{{Form::submit('upload')}}
{{Form::close()}}

@stop