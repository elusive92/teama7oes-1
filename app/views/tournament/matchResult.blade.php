@extends('layout.main')

@section('title')

@stop

@section('content')
@if(Auth::check())
<table class="table table-bordered table-striped" style="color: red">
    <h3>Who has won?</h3>
    <tr>
        <td style="width: 40%">
            <form action="{{ URL::route('matchResultPostA') }}" method="post">
                <input type="hidden" name="matchId" value="{{ $match->id }}"/>
                <input type="submit" value="Team A" class="btn btn-default"/>
            </form>
        </td>
        <td style="width: 10%"></td>
        <td style="width: 45%">
            <form action="{{ URL::route('matchResultPostB') }}"  method="post">
                <input type="hidden" name="matchId" value="{{ $match->id }}"/>
                <input type="submit" value="Team B" class="btn btn-default"/>
            </form>
        </td>
    </tr>
    <tr>
        <td><a href="{{ URL::route('teamprofile', $match->teamA->teamname) }}">{{ $match->teamA->teamname }}</a></td>
        <td style="text-align: center">vs.</td>
        <td style="text-align:right"><a href="{{ URL::route('teamprofile', $match->teamB->teamname) }}"> {{ $match->teamB->teamname }} </a></td>
    </tr>
</table>
<div class="clearfix"></div>
@endif
@stop
