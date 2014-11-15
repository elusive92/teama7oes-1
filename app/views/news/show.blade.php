@extends('layout.main')

@section('title')
	{{$news->title}}
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li><a href="#">News</a></li>
      <li>{{Str::limit($news->title, 50)}}</li>
</ol>


		<article>
			<p><a href=""><img src="{{ URL::asset('/') }}img/avatar_example.jpg" class="imgsize"></a></p>
			<h3> {{$news->title}} </h3>
			<p> {{ $news->descript }}</p>
			<a href="{{ URL::route('home')}}"><span><img src="{{ URL::asset('/') }}img/ico/back.png"/></span> Go back</a>
			
		</article>


@stop
