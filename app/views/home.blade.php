@extends('layout.main')

@section('title')
	Home
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>  
      <li>News general</li>
</ol>
 @if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
 @endif
	@if($news->count())
		@foreach($news as $new)
			<ul id="news_list">
				<li class="clearfix">
					<a href="">
						<img src="{{ URL::asset('/') }}img/avatar_example.jpg" height="100" width="100">
					</a>
					<h3><a href="{{ URL::action('news-show', $new->id) }}">{{Str::limit($new->title, 40)}} </a></h3>
					<p> {{Str::limit($new->descript, 200)}}</p>
<span id="news_list"> </span>
					<a href="{{ URL::action('news-show', $new->id) }}" >Read more </a>
		@if(Auth::check())
  			    @if((Auth::user()->permissions == 1) || (Auth::user()->permissions == 2))
				|| <a href="{{ URL::action('news-edit', $new->id) }}">Edit </a>||
					<a href="{{ URL::action('news-delete', $new->id) }}">Delete </a>
    		    @endif
 	    @endif					
					<p class="ptime"> Created at {{ $new->created_at }} </p>
				</li>
			</ul>
		@endforeach
	@endif

	@if(Auth::check())
        @if((Auth::user()->permissions == 1) || (Auth::user()->permissions == 2))
        <div id="brejker">
        <div class="newsbutton">
        <a href="{{ URL::route('news-add')}}" class="btn btn-default btn-xs" style="color:black">
          <span><img src="{{ URL::asset('/') }}img/ico/pencil.png"/></span> Add news
    	</a>
    	<a href="{{ URL::route('manage-news')}}" class="btn btn-default btn-xs" style="color:black">
          <span><img src="{{ URL::asset('/') }}img/ico/news.png"/></span> Manage news
    	</a>
    	</div>
    	</div>
        @endif
    @endif

@stop