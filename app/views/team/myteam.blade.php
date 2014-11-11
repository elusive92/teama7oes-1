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
<table class="table table-bordered table-striped">
    <thead>
        <!--<h2>Ranking</h2> -->
    </thead>
    <tr>
        <td></td>
        <td>Team Name</td>
        <td>Ranking</td>
    </tr>
<?php $i = 1; ?>
    @foreach($teams as $teamrank)
    <tr>
        <td><?php echo $i; ?>.</td>
        <td><a href="{{ URL::route('teamprofile', $teamrank->teamname) }}">{{ e($teamrank->teamname) }}</a></td>
        <td>{{ e($teamrank->ranking) }}</td>
        <?php $i++; ?>
    </tr>


    @endforeach
</table>
</div>

<div id="teamsView" class="myteam">
@if($team)
    <a href="{{ URL::route('team-quit')}}" class="btn btn-default">Quit team</a>
    @if($team->id == Auth::check())
        <a href="{{ URL::route('team-edit')}}" class="btn btn-default">Edit team</a>
    @endif

    <div class="teamphoto">
    @if($team->logo)
        {{ HTML::image('img/teams/logos/'.$team->logo, '', ['width' => '180', 'height' => '180']) }}
    @endif
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