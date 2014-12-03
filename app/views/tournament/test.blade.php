@extends('layout.main')

@section('title')

@stop

@section('content')
<table class="table table-bordered table-striped" style="color: red">
    <tr>
        {{--<td>Result</td>--}}
        <td>Team A</td>
        <td></td>
        <td>Team B</td>
        {{--<td>Result</td>--}}
    </tr>
    @foreach($matches as $match)
    <tr>
        {{--<td></td>--}}
        <td ><a href="{{ URL::route('teamprofile', $match->teamA->teamname) }}" style="color: @if($match->result == 1) green @elseif($match->result == 2) #d40d12 @else orange @endif ;">{{ $match->teamA->teamname }}</a></td>
        <td style="text-align: center">vs.</td>
        <td style="text-align:right"><a href="{{ URL::route('teamprofile', $match->teamB->teamname) }}" style="color: @if($match->result == 2) green @elseif($match->result == 1) #d40d12 @else orange @endif ;">{{ $match->teamB->teamname }}</a></td>
        {{--<td></td>--}}
    </tr>


    @endforeach
</table>
<div class="clearfix"></div>
@stop
