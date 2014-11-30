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
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li>{{ e($team->teamname) }}</li>
</ol>
<div id="teamsView">
        <div class="teamphoto">
          @if($team->logo)
            {{ HTML::image('img/teams/logos/'.$team->logo, '', ['width' => '180', 'height' => '180']) }}
          @endif
        </div>
        <div class="data">
          <div  class="teamName"><h1>{{ e($team->teamname) }}</h1></div>
          <h5>From:</h5>
          <h5>Registered: {{ e($team->created_at->format('d F Y')) }}</h5>
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