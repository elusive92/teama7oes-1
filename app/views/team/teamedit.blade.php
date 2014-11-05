@extends('layout.main')

@section('title')
	@if($team)
	{{ e($team->teamname) }}
	@else
	404
	@endif
@stop

@section('content')
@if($team->id == Auth::check())
<div class="myteamedit">
    <div class="teamphoto">
            WYBÓR ZDJĘCIA
        </div>
        <div class="data">
            <h5>From: </h5> WYBÓR KRAJU
            <h5>Teammembers: </h5> WPISYWANIE NICKU
        </div>
    <div class="sep"></div>
</div>
<div id="teamsView" class="myteam">
    <div class="teamphoto">

        <a href="#"><img src="" width="150" height="150" /></a>
    </div>
    <div class="data">
        <h5>From: </h5>

        @if($teammembers)
            <h5>Teammembers: </h5>
            @foreach($teammembers as $teammember)
                <p>{{ e($teammember->user->username) }}</p>
            @endforeach
        @endif
    </div>
    <div class="sep"></div>
</div>
<div style="clear:both"></div>
@endif



@stop