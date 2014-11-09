@extends('layout.main')

@section('title')
	Home
@stop

@section('content')
	
	@if($news->count())
		@foreach($news as $new)
			<article>
				<h3><a href="{{ URL::action('news-show', $new->id) }}">{{$new->title}} </a></h3>
				<p> Created at {{ $new->created_at }} </p>
				<p> {{Str::limit($new->descript, 130)}}</p>
				<a href="{{ URL::action('news-show', $new->id) }}">Read moar </a>
			</article>
		@endforeach
	@endif



@stop