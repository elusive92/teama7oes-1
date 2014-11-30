@extends('layout.main')

@section('title')
	Tournaments
@stop

@section('content')

<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li>Tournaments</li>
</ol>

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
                    <h3><a href="{{ URL::action('tournament-show', $tournament->id) }}">{{Str::limit($tournament->name, 40)}} </a></h3>
                    <p> {{Str::limit($tournament->descript, 200)}}</p>
                    <p>{{ e($tournament->startdate) }}</p>
        <span id="news_list"> </span>
        <a href="{{ URL::action('tournament-show', $tournament->id) }}" >Read more </a>

    @if(Auth::check())
                @if((Auth::user()->permissions == 1) || (Auth::user()->permissions == 2))
                
                Edit    
                Delete
                
                @endif
    @endif
    </li>
    </ul>  
    @endforeach
</div>

@if(Auth::check())
    @if(Auth::user()->permissions == 1 || (Auth::user()->permissions == 2)) 
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