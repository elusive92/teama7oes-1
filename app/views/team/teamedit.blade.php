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
<div class="alert alert-info info" style="display: none;">
        <ul></ul>
</div>
<div class="myteamedit">
    <div class="teamphoto">
            WYBÓR ZDJĘCIA
            {{ Form::open( array('route' => 'team-edit-post', 'class'=>'form-horizontal', 'files' => true)) }}

            {{Form::file('logo')}}

            {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}

            {{ Form::close() }}
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
        @if($teaminvitations)
            <h5>Pending invitations: </h5>
            @foreach($teaminvitations as $teaminvitation)
                <p>{{ e($teaminvitation->user->username) }}</p>
            @endforeach
        @endif
    </div>
    <div class="sep"></div>
</div>
<div style="clear:both"></div>
@endif



@stop