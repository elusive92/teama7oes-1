@extends('layout.main')

@section('title')
	Tournaments
@stop

@section('content')
	tournaments
	{{Cookie::get('gameid')}}

@if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif

<div class="lista">
    <?php $i = 1; ?>
    @foreach($tournaments as $tournament)
    <ul id="news_list">
                <li class="clearfix">
                    <a href="">
                        <img src="{{ URL::asset('/') }}img/avatar_example.jpg" height="100" width="100">
                    </a>
                    <h3>{{ e($tournament->name) }}</h3>
                    <p> {{Str::limit($tournament->descript, 200)}}</p>
                    <p>{{ e($tournament->startdate) }}</p>
    <span id="news_list"> </span>

    @if(Auth::check())
                @if((Auth::user()->permissions == 1) || (Auth::user()->permissions == 2))
                <p>Read more
                Edit    
                Delete</p>
                
                @endif
    @endif  
    @endforeach
</div>

@if(Auth::check())
    @if(Auth::user()->permissions == 1)
        <div id="brejker">
        <div class="newsbutton">
        <a href="{{ URL::route('tournament-add')}}" class="btn btn-default btn-xs">
          <span><img src="{{ URL::asset('/') }}img/ico/pencil.png"/></span> Add Tournament
        </a>
        <a href="{{ URL::route('manage-tournament')}}" class="btn btn-default btn-xs">
          <span><img src="{{ URL::asset('/') }}img/ico/news.png"/></span> Manage Tournament
        </a>
        </div>
        </div>
    @endif
@endif

@stop