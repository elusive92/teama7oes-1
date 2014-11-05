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

<div id="teamsView" class="myteam">
@if($team)
    <a href="{{ URL::route('team-quit')}}" class="btn btn-default">Quit your team.</a>
    @if($team->id == Auth::check())
        <a href="{{ URL::route('team-edit')}}" class="btn btn-default">Edit team</a>
    @endif
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
@else
    @if(Auth::check())
        <a href="{{ URL::route('team-create')}}" class="btn btn-default">Create team</a>
    @endif
@endif
</div>
<div style="clear:both"></div>

@stop