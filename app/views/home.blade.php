@extends('layout.main')

@section('title')
	Home
@stop

@section('content')
	
	@if($news->count())
		@foreach($news as $new)
			<ul id="news_list">
				<li class="clearfix">
					<a href="">
						<img src="{{ URL::asset('/') }}img/avatar_example.jpg" height="50" width="60">
					</a>
					<h3><a href="{{ URL::action('news-show', $new->id) }}">{{$new->title}} </a></h3>
					<p> {{Str::limit($new->descript, 200)}}</p>
					<a href="{{ URL::action('news-show', $new->id) }}">Read moar </a>
					<p class="ptime"> Created at {{ $new->created_at }} </p>
				</li>
			</ul>
		@endforeach
	@endif



@stop