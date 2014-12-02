@extends('layout.main')

@section('title')
	@if($team)
	{{ e($team->teamname) }}
	@else
	Ranking
	@endif
@stop

@section('content')
<ol class="breadcrumb">
      <li id="gohome"><a href="">Home</a></li>
      <li><a href="{{ URL::route('home')}}">{{ e($game->gamename) }}</a></li>
      <li>Teams</li>
</ol>
@if($teams)
    <div class="rank">
    <table class="table table-bordered table-striped">
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
            <td style="text-align:right">{{ e($teamrank->ranking) }}</td>
            <?php $i++; ?>
        </tr>


        @endforeach
    </table>
    </div>
@endif

<div id="teamsView" class="myteam">
@if($team)
    <a href="{{ URL::route('team-quit')}}" class="btn btn-default">Quit team</a>
    @if(($team->user_id) == (Auth::user()->id))
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
        @if($teaminvitations)
            <p>You have been invited to be a part of team:</p>
            @foreach($teaminvitations as $teaminvitation)
                @if((strtotime(date("Y-m-d H:i:s")) - strtotime($teaminvitation->date)) < 604800)
                    <ul class="nav navbar-nav">
                        <li><a href="{{ URL::route('teamprofile', $teaminvitation->team->teamname) }}" style="padding: 0px;">{{ e($teaminvitation->team->teamname) }}</a></li>
                        <li style="float:right; padding-left: 15px;">
                            {{Form::open(array('route' => 'team-dec-inv'))}}
                            {{Form::hidden('id', $teaminvitation->id)}}
                            <button type="submit"  class="btn btn-danger btn-xs">Decline</button>
                            {{Form::close()}}
                        </li>
                        <li style="float:right; padding-left: 15px;">
                            {{Form::open(array('route' => 'team-acc-inv'))}}
                            {{Form::hidden('id', $teaminvitation->id)}}
                            <button type="submit"  class="btn btn-success btn-xs">Accept</button>
                            {{Form::close()}}
                        </li>

                    </ul>
                @endif
            @endforeach
        @endif
    @endif
@endif
</div>
<div style="clear:both"></div>

@stop