@extends('layout.main')

@section('title')
	Tournaments
@stop

@section('content')

<ol class="breadcrumb">
      <li id="gohome"><a href="">Home</a></li>
      <li><a href="{{ URL::route('home')}}">{{ e($game->gamename) }}</a></li>
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
                    <h3><a href="{{ URL::action('tournament-show', $tournament->id) }}">{{Str::limit($tournament->name, 40)}} </a></h3>
                    <p>Description: {{e($tournament->descript)}} </p>
                    <p>Rejestracja do: {{ e($tournament->regdate) }}
                    <p>Start: {{ e($tournament->startdate) }}</p>
        <span id="news_list"> </span>
        <a href="{{ URL::action('tournament-show', $tournament->id) }}" >Read more </a>

    @if(Auth::check())
                @if((Auth::user()->permissions == 1) || (Auth::user()->permissions == 2))                
                  <!--  Edit    
                    Delete-->   
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