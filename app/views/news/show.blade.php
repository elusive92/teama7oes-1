@extends('layout.main')

@section('title')
	{{$news->title}}
@stop

@section('content')
	
		<article>
			<h3> {{$news->title}} </h3>
			<p> {{ $news->descript }}</p>
		</article>


@stop