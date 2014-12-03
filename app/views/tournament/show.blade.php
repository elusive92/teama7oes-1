@extends('layout.main')

@section('title')
	{{$tournament->name}}
@stop

@section('content')
<ol class="breadcrumb">
      <li><a href="{{ URL::route('home')}}">Home</a></li>
      <li><a href="{{ URL::route('tournaments')}}">Tournament</a></li>
      <li>{{Str::limit($tournament->name, 50)}}</li>
</ol>

@if(Session::has('message'))
  <p class="alert alert-info">{{ Session::get('message') }}</p>
@endif
@if($tournamentmembers)
        <div class="pull-right">
        		<table class="table table-bordered table-striped" style="color: red">
                    <tr>
                        {{--<td>Result</td>--}}
                        <td>Teamname</td>
                        <td>Wins</td>
                        {{--<td>Result</td>--}}
                    </tr>
                    @foreach($tournamentmembers as $tournamentmember)
                    <tr>
                        {{--<td></td>--}}
                        <td><a href="{{ URL::route('teamprofile', $tournamentmember['teamname']) }}">{{ $tournamentmember['teamname'] }}</a></td>
                        <td style="text-align:right">{{ $tournamentmember['wins'] }}</td>
                        {{--<td></td>--}}
                    </tr>


                    @endforeach
                </table>
        </div>
@endif
@if($tournament->status == 2)
    <a href="{{ URL::route('showMatches', $tournament->id) }}" class="btn btn-default">Show Matches</a>
@endif
@if(Auth::check())
    @if(($tournament->status == 1) && (Auth::user()->permissions > 0))
        <a href="{{ URL::route('makeMatches', $tournament->id) }}" class="btn btn-default">Start Tournament</a>
    @endif
@endif
		<div>

			<p><a href=""><img src="{{ URL::asset('/') }}img/avatar_example.jpg" class="imgsize"></a></p>
			<h2> {{$tournament->name}} </h2>
			<p>Description: {{ $tournament->descript }}</p>
			<p>Rejestracja do: {{ e($tournament->regdate) }}
            <p>Start: {{ e($tournament->startdate) }}</p>
        @if(Auth::check())
            @if($tournament->status == 0 & $addteam)
                    <div class="clear"><a href="{{ URL::action('join-Tournament', $tournament->id) }}" class="btn btn-default">Join Tournament</a></div>
            @endif
        @endif

			<a href="{{ URL::route('tournaments')}}"><span><img src="{{ URL::asset('/') }}img/ico/back.png"/></span> Go back</a>
			
		</div>

		<div class="clearfix"></div>


@stop
