@extends('layout.main')

@section('title')

@stop

@section('content')
<table class="table table-bordered table-striped" style="color: red">
    <tr>
        {{--<td>Result</td>--}}
        <td style="width: 35%">Team A</td>
        <td style="width: 30%"></td>
        <td style="width: 35%">Team B</td>
        {{--<td>Result</td>--}}
    </tr>
    @foreach($matches as $match)
        <tr>
            {{--<td></td>--}}
            <td >@if($match->id_teamsA)<a href="{{ URL::route('teamprofile', $match->teamA->teamname) }}" style="color: @if($match->result == 1) green @elseif($match->result == 2) #d40d12 @else orange @endif ;">{{ $match->teamA->teamname }}</a>@else <b style=" color: #d40d12">FREE WIN</b> @endif</td>
            <td style="text-align: center">
                @if(Auth::check())
                    @if(($match->result == 0) && (($match->teamA->user_id == Auth::user()->id) || ($match->teamB->user_id == Auth::user()->id)))
                        <a href="{{ URL::route('matchResult', $match->id) }}">Send result</a>
                    @else
                        vs.
                    @endif
                @else
                    vs.
                @endif

            </td>
            <td style="text-align:right">@if($match->id_teamsB)<a href="{{ URL::route('teamprofile', $match->teamB->teamname) }}" style="color: @if($match->result == 2) green @elseif($match->result == 1) #d40d12 @else orange @endif ;">{{ $match->teamB->teamname }}</a>@else <b style=" color: #d40d12">FREE WIN</b> @endif</td>
            {{--<td></td>--}}
        </tr>
    @endforeach
    </table>
@if(Auth::check())
    <table class="table table-bordered table-striped" style="color: red">
    <caption>Results conflict</caption>
        <tr>
            <td style="width: 35%">Team A</td>
            <td style="width: 30%"></td>
            <td style="width: 35%">Team B</td>
        </tr>

        @foreach($conflicts as $conflict)
            <tr>
                {{--<td></td>--}}
                <td ><a href="{{ URL::route('teamprofile', $conflict->teamA->teamname) }}" style="color:orange ;">{{ $conflict->teamA->teamname }}</a></td>
                <td style="text-align: center">
                    <a href="{{ URL::route('matchResultMod', $conflict->id) }}">Send result</a>
                </td>
                <td style="text-align:right"><a href="{{ URL::route('teamprofile', $conflict->teamB->teamname) }}" style="color: orange;">{{ $conflict->teamB->teamname }}</a></td>
                {{--<td></td>--}}
            </tr>
        @endforeach
        @foreach($conflicts1 as $conflict1)
            <tr>
                {{--<td></td>--}}
                <td ><a href="{{ URL::route('teamprofile', $conflict1->teamA->teamname) }}" style="color:orange ;">{{ $conflict1->teamA->teamname }}</a></td>
                <td style="text-align: center">
                    <a href="{{ URL::route('matchResultMod', $conflict1->id) }}">Send result</a>
                </td>
                <td style="text-align:right"><a href="{{ URL::route('teamprofile', $conflict1->teamB->teamname) }}" style="color: orange;">{{ $conflict1->teamB->teamname }}</a></td>
                {{--<td></td>--}}
            </tr>
        @endforeach
    </table>
@endif
<div class="clearfix"></div>

@stop
