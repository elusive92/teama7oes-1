@extends('layout.main')

@section('title')
	@if($team)
	{{ e($team->teamname) }}
	@else
	Ranking
	@endif
@stop

@section('content')
<div class="rank">
    <h2>Ranking</h2>
</div>
@if($team)
<div id="teamsView" class="myteam">
        <div class="teamphoto">
          <a href="#"><img src="" width="150" height="150" /></a>
        </div>
        <div class="data">
          <div  class="teamName"><h1>{{ e($team->teamname) }}</h1></div>
          <h5>From: </h5>
          <h5>Registered: {{ e($team->created_at->format('d F Y')) }}</h5>
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
<div style="clear:both"></div>

@stop