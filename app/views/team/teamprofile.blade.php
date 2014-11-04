@extends('layout.main')

@section('title')
	@if($team)
	{{ e($team->teamname) }}
	@else
	404
	@endif
@stop

@section('content')
@if($team)
<div id="teamsView">
        <div class="teamphoto">
          <a href="#"><img src="" width="150" height="150" /></a>
        </div>
        <div class="data">
          <div  class="teamName"><h1>{{ e($team->teamname) }}</h1></div>
          <h5>From: (kraj, moze flaga?)</h5>
          <h5>Registered: </h5>
          <h5>Games:</h5>
          @if($teammembers)
          <h5>Teammembers: </h5>
          @foreach($teammembers as $teammember)
            <p>{{ e($teammember->user->username) }}</p>
          @endforeach
          @endif
        </div>
        <div class="sep"></div>
      </div>


@else
<h1>This team doesn't exists</h1>
@endif


@stop